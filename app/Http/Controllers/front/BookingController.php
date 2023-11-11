<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Stripe;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\BookedRoom;

class BookingController extends Controller
{
    public function cart_submit(Request $request)
    {
        // リクエストデータのバリデーションを行います。
        $request->validate([
            'room_id' => ['required'],
            'checkin_checkout' => ['required'],
            'adult' => ['required'],
            'children' => ['required'],
        ]);
    
        // `checkin_checkout` の値をハイフンで分割し、チェックイン日とチェックアウト日を取得します。
        $dates = explode(' - ', $request->checkin_checkout);
        $checkin_date = $dates[0];
        $checkout_date = $dates[1];
    
        // 取得した日付を処理するためにフォーマットを変更します。
        $d1 = explode('-', $checkin_date);
        $d2 = explode('-', $checkout_date);
        $d1_new = $d1[0].'-'.$d1[1].'-'.$d1[2];
        $d2_new = $d2[0].'-'.$d2[1].'-'.$d2[2];
        $t1 = strtotime($d1_new);
        $t2 = strtotime($d2_new);
    
        // 予約された部屋の総数を計算します。
        $cut = 1;
        while(1) {
            if ($t1 >= $t2) {
                break;
            }
            $single_data = date('d/m/Y', $t1);
            // 特定の予約日とルームIDに一致する BookedRoom モデルのレコードをカウントします。
            $total_allready_booked_rooms = BookedRoom::where('booking_date',$single_data)->where('room_id',$request->room_id)->count();
            // Room モデルから指定されたルームIDに一致するレコードを取得します。
            $arr = Room::where('id', $request->room_id)->first();
            // ルームの総数を取得します。
            $total_allowed_rooms = $arr->total_rooms;
    
            // 既に予約された部屋の総数が許容される部屋の総数と同じ場合、`cut` フラグを 0 に設定し、ループを終了します。
            if ($total_allready_booked_rooms == $total_allowed_rooms) {
                $cut = 0;
                break;
            }
            $t1 = strtotime('+1 day', $t1);
        }
    
        // `cut` フラグが 0 の場合、最大予約数に達しているためリダイレクトします。
        if ($cut == 0) {
            return redirect()->back()->with('error', 'お部屋の予約数が最大です、ご予約ができません。');
        }
    
        // セッションにカートの情報を追加します。
        session()->push('cart_room_id', $request->room_id);
        session()->push('cart_checkin_date', $checkin_date);
        session()->push('cart_checkout_date', $checkout_date);
        session()->push('cart_adult', $request->adult);
        session()->push('cart_children', $request->children);
    
        // リダイレクトして成功メッセージを表示します。
        return redirect()->back()->with('success', 'カートにアイテムを追加しました。');
    }
    

    public function cart_view()
    {
        return view('front.cart');
    }

    public function cart_delete($id)
    {
         // 値を格納するための配列を作成します
        $arr_cart_room_id = array();
        $i = 0;

        // 'cart_room_id'セッション配列を繰り返し処理し、各値を新しい配列に格納します
         // 他のセッション変数（'cart_checkin_date'、'cart_checkout_date'、'cart_adult'、'cart_children'）に対しても上記のプロセスを繰り返します
        foreach (session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i = 0;
        foreach (session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i = 0;
        foreach (session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i = 0;
        foreach (session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i = 0;
        foreach (session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

          // 既存のセッション変数を削除します
        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');

         // 'arr_cart_room_id'配列をループして、$idと一致するアイテムを除外して、それ以外の値を各自のセッション変数に再度追加します
        for ($i = 0; $i < count($arr_cart_room_id); $i++) {
            if ($arr_cart_room_id[$i] == $id) {
                continue;
            } else {
                session()->push('cart_room_id', $arr_cart_room_id[$i]);
                session()->push('cart_checkin_date', $arr_cart_checkin_date[$i]);
                session()->push('cart_checkout_date', $arr_cart_checkout_date[$i]);
                session()->push('cart_adult', $arr_cart_adult[$i]);
                session()->push('cart_children', $arr_cart_children[$i]);
            }
        }

       // 前のページにリダイレクトし、カートアイテムが削除されたことを示す成功メッセージを表示します
        return redirect()->back()->with('success', 'カート内のアイテムを削除しました。');
    }

    public function checkout()
    {
    
        // カスタマーがログインしていない場合、エラーメッセージとともに前のページにリダイレクトする
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'チェックアウトするにはログインする必要があります。');
        }
    
        // カートにアイテムがない場合、エラーメッセージとともに前のページにリダイレクトする
        if (!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'カートにアイテムがありません。');
        }
    
        // カスタマーがログインしており、カートにアイテムがある場合、'front.checkout'ビューを表示する
        return view('front.checkout');
    }
    

    public function payment(Request $request)
    {
        // ユーザーがログインしていない場合は、エラーメッセージと共に戻る
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'チェックアウトするにはログインする必要があります。');
        }
    
        // カートにアイテムがない場合は、エラーメッセージと共に戻る
        if (!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'カートにアイテムがありません。');
        }
    
        // 請求情報のリクエストデータを検証する
        $request->validate([
            'billing_name' => ['required'],
            'billing_email' => ['required', 'email'],
            'billing_phone' => ['required'],
            'billing_country' => ['required'],
            'billing_address' => ['required'],
            'billing_state' => ['required'],
            'billing_city' => ['required'],
            'billing_zip' => ['required'],
        ]);
    
        // 検証された請求情報をセッション変数に保存する
        session()->put('billing_name', $request->billing_name);
        session()->put('billing_email', $request->billing_email);
        session()->put('billing_phone', $request->billing_phone);
        session()->put('billing_country', $request->billing_country);
        session()->put('billing_address', $request->billing_address);
        session()->put('billing_state', $request->billing_state);
        session()->put('billing_city', $request->billing_city);
        session()->put('billing_zip', $request->billing_zip);
    
        // 'front.payment'ビューを表示する
        return view('front.payment');
    }
    
    // Paypal決済実装予定（仮）

    // public function paypal()
    // {
    //         $final_price = '5';
    //         $client = 'AbE9iou3ITqq_W5ofcM_WBK7mK6BN19kFZ9URfTqLp7q2U5yxkh2rGxXXoqCBq_22-Y_o-Q4FoByr3iY';
    //         $secret = 'EIDWTlv0RZi8q81whlj-GaEkl7r09b5YHvtqxEzpoElFpGO2QTP2CHgd3mtS_-YZ9sdrZaU3acsK8vPt';
    //         $apiContext = new \PayPal\Rest\ApiContext(
    //             new \PayPal\Auth\OAuthTokenCredential(
    //                 $client, // ClientID
    //                 $secret // ClientSecret
    //             )
    //         );
    //         $paymentId = request('paymentId');
    //         $payment = Payment::get($paymentId, $apiContext);

    //        $execution = new PaymentExecution();
    //        $execution->setPayerId(request('PayerID'));

    //        $transaction = new Transaction();
    //        $amount = new Amount();
    //        $details = new Details();

    //        $details->setShipping(0)
    //        ->setTax(0)
    //        ->setSubtotal($final_price);

    //        $amount->setCurrency('JPY');
    //        $amount->setTotal($final_price);
    //        $amount->setDetails($details);
    //        $transaction->setAmount($amount);
    //        $execution->addTransaction($transaction);

    //        $result = $payment->execute($execution, $apiContext);

    //        if($result->state == 'approved'){
    //          $paid_amount = $result->transactions[0]->amount->total;
    //         }
    // }

    public function stripe(Request $request,$final_price)
    {
         // Stripeのシークレットキーを設定
        $stripe_secret_key = 'sk_test_51Mbqc2FCKRLhb99RTxg8YAJYmRqKXPwRg193ICR0c8CxFFSEfuhYiKXaJBo09YUQhM78Xvt2p816hW9RgYL4L2R100oorvMifN';
        // 金額を円単位に変換
        $yens = $final_price;

        // Stripe APIのシークレットキーをセット
        Stripe\Stripe::setApiKey($stripe_secret_key);

        // Stripeのサーバーに支払い情報を送信して課金を作成
        $response = Stripe\Charge::create([
            "amount" => $yens,
            "currency" => "jpy",
            "source" => $request->stripeToken,
            "description" => env('APP_NAME')
        ]);
        
        // レスポンスをJSON形式に変換
        $responseJson = $response->jsonSerialize();
        
         // 取引IDとカードの最後の4桁を取得
        $transaction_id = $responseJson['balance_transaction'];
        $last_4 = $responseJson['payment_method_details']['card']['last4'];

         // 注文番号を現在時刻から生成
        $order_no = time();

        // 'orders'テーブルのAuto_incrementの次のIDを取得
        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $ai_id = $statement[0]->Auto_increment;

        // Orderモデルを作成してデータを保存
        $obj = new Order();
        $obj->customer_id = Auth::guard('customer')->user()->id;
        $obj->order_no = $order_no;
        $obj->transaction_id = $transaction_id;
        $obj->payment_method = 'Stripe';
        $obj->card_last_digit = $last_4;
        $obj->paid_amount = $final_price;
        $obj->booking_date = date('d/m/Y');
        $obj->status = 'Completed';
        $obj->save();
        
         // カート内の各アイテムの詳細を保存するために配列から順番にデータを取り出す
        // 同様に他の配列もデータを取得する
        // arr_cart_checkin_date, arr_cart_checkout_date, arr_cart_adult, arr_cart_children
        $arr_cart_room_id = array();
        $i=0;
        foreach(session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i=0;
        foreach(session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i=0;
        foreach(session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i=0;
        foreach(session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i=0;
        foreach(session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

         // 各ルームごとに注文の詳細を保存し、予約日を生成
        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            // ルームの詳細をDBから取得
            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();

            // チェックイン日とチェックアウト日を取得し、差分を計算
            $d1 = explode('-',$arr_cart_checkin_date[$i]);
            $d2 = explode('-',$arr_cart_checkout_date[$i]);
            $d1_new = $d1[0].'-'.$d1[1].'-'.$d1[2];
            $d2_new = $d2[0].'-'.$d2[1].'-'.$d2[2];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2-$t1)/60/60/24;

             // 小計を計算 
            $sub = $r_info->price*$diff;

             // OrderDetailモデルを作成して詳細データを保存
            $obj = new OrderDetail();
            $obj->order_id = $ai_id;
            $obj->room_id = $arr_cart_room_id[$i];
            $obj->order_no = $order_no;
            $obj->checkin_date = $arr_cart_checkin_date[$i];
            $obj->checkout_date = $arr_cart_checkout_date[$i];
            $obj->adult = $arr_cart_adult[$i];
            $obj->children = $arr_cart_children[$i];
            $obj->subtotal = $sub;
            $obj->save();

            // チェックイン日からチェックアウト日までの各日に予約済みの部屋を保存
            while(1) {
                if($t1>=$t2) {
                    break;
                }
                $obj = new BookedRoom();
                $obj->booking_date = date('d/m/Y',$t1);
                $obj->order_no = $order_no;
                $obj->room_id = $arr_cart_room_id[$i];
                $obj->save();

                $t1 = strtotime('+1 day',$t1);
            }

        }

         // 支払いが完了したら、セッションからカートのデータを削除してホームページにリダイレクト
        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');
        session()->forget('billing_name');
        session()->forget('billing_email');
        session()->forget('billing_phone');
        session()->forget('billing_country');
        session()->forget('billing_address');
        session()->forget('billing_state');
        session()->forget('billing_city');
        session()->forget('billing_zip');

        return redirect()->route('home')->with('success', 'お支払いが完了いたしました。');        
    }
}
