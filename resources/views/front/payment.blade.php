@extends('front.layout.app')

@section('main_content')

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->payment_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
                <div class="col-lg-4 col-md-4 checkout-left mb_30">
                    @php
                    $arr_cart_room_id = array();
                    $i = 0;
                    foreach(session()->get('cart_room_id') as $value) {
                      $arr_cart_room_id[$i] = $value;
                      $i++;
                    }
                    $arr_cart_checkin_date = array();
                    $i = 0;
                    foreach(session()->get('cart_checkin_date') as $value) {
                      $arr_cart_checkin_date[$i] = $value;
                      $i++;
                    }
                    $arr_cart_checkout_date = array();
                    $i = 0;
                    foreach(session()->get('cart_checkout_date') as $value) {
                      $arr_cart_checkout_date[$i] = $value;
                      $i++;
                    }
                    $arr_cart_adult = array();
                    $i = 0;
                    foreach(session()->get('cart_adult') as $value) {
                      $arr_cart_adult[$i] = $value;
                      $i++;
                    }
                    $arr_cart_children = array();
                    $i = 0;
                    foreach(session()->get('cart_children') as $value) {
                      $arr_cart_children[$i] = $value;
                      $i++;
                    }
                    $total_price = 0;
                    for($i = 0; $i < count($arr_cart_room_id); $i++){
                      $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                            $d1 = explode('-',$arr_cart_checkin_date[$i]);
                            $d2 = explode('-',$arr_cart_checkout_date[$i]);
                            $d1_new = $d1[0].'-'.$d1[1].'-'.$d1[2];
                            $d2_new = $d2[0].'-'.$d2[1].'-'.$d2[2];
                            $t1 = strtotime($d1_new);
                            $t2 =  strtotime($d2_new);
                            $diff = ($t2 - $t1) / 60 / 60 /24;
                            $price_Subtotal = $room_data->price * $diff;
                            $total_price  =   $total_price   + $price_Subtotal;
                    }
                  @endphp
                    <h4>Make Payment</h4>
                    <select name="payment_method" class="form-control select2" id="paymentMethodChange" autocomplete="off">
                        <option value="">Select Payment Method</option>
                        <option value="PayPal">PayPal<span>(準備中)</span></option>
                        <option value="Stripe">Stripe</option>
                    </select>

                    {{-- <div class="paypal mt_20">
                        <div id="paypal-button"></div>
                    </div> --}}

                    <div class="stripe mt_20">
                        @php 
                          $cents =  $total_price ;
                          $customer_email = Auth::guard('customer')->user()->email;
                          $stripe_public_key = "pk_test_51Mbqc2FCKRLhb99RfVJh6KM0rchKUpDFCndgfCQ1gcqCRihpcW8QjfeEqEN9abrxWWnpkNmkKppZn6MlFgp7M9h1007OsFShLF";
                        @endphp
                        <form action="{{ route('stripe',$total_price) }}" method="post">
                            @csrf
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ $stripe_public_key }}"
                                data-amount="{{ $cents }}"
                                data-name="{{ env('APP_NAME') }}"
                                data-description=""
                                data-image="{{ asset('uploads/stripe_icon.png') }}"
                                data-currency="jpy"
                                data-email="{{ $customer_email }}"
                            >
                            </script>
                        </form>
                    </div>
                </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Billing Details</h4>
                    <div>名前: {{ session()->get('billing_name') }}</div>
                    <div>メールアドレス: {{ session()->get('billing_email') }}</div>
                    <div>電話番号: {{ session()->get('billing_phone') }}</div>
                    <div>郵便番号: {{ session()->get('billing_zip') }}</div>
                    <div>国:{{ session()->get('billing_country') }}</div>
                  　<div>都道府県: {{ session()->get('billing_state') }}</div>
                  　<div>市区町村: {{ session()->get('billing_city') }}</div>
                    <div>その他の住所(マンションなど): {{ session()->get('billing_address') }}</div>
                </div>
            </div>
                <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Cart Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @php
                                $arr_cart_room_id = array();
                                $i = 0;
                                foreach(session()->get('cart_room_id') as $value) {
                                  $arr_cart_room_id[$i] = $value;
                                  $i++;
                                }
  
                                $arr_cart_checkin_date = array();
                                $i = 0;
                                foreach(session()->get('cart_checkin_date') as $value) {
                                  $arr_cart_checkin_date[$i] = $value;
                                  $i++;
                                }
  
                                $arr_cart_checkout_date = array();
                                $i = 0;
                                foreach(session()->get('cart_checkout_date') as $value) {
                                  $arr_cart_checkout_date[$i] = $value;
                                  $i++;
                                }
  
                                $arr_cart_adult = array();
                                $i = 0;
                                foreach(session()->get('cart_adult') as $value) {
                                  $arr_cart_adult[$i] = $value;
                                  $i++;
                                }
  
                                $arr_cart_children = array();
                                $i = 0;
                                foreach(session()->get('cart_children') as $value) {
                                  $arr_cart_children[$i] = $value;
                                  $i++;
                                }
                                $total_price = 0;
                                for($i = 0; $i < count($arr_cart_room_id); $i++){
                                  $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                                  @endphp 
                                  <tr>
                                    <td>
                                        {{ $room_data->name }}
                                        <br>
                                        {{ $arr_cart_checkin_date[$i] }} - {{ $arr_cart_checkout_date[$i] }}
                                        <br>
                                        大人: {{ $arr_cart_adult[$i] }}, 子ども: {{ $arr_cart_children[$i] }}
                                    </td>
                                    <td class="p_price">
                                        @php 
                                        $d1 = explode('-',$arr_cart_checkin_date[$i]);
                                        $d2 = explode('-',$arr_cart_checkout_date[$i]);
                                        $d1_new = $d1[0].'-'.$d1[1].'-'.$d1[2];
                                        $d2_new = $d2[0].'-'.$d2[1].'-'.$d2[2];
                                        $t1 = strtotime($d1_new);
                                        $t2 =  strtotime($d2_new);
                                        $diff = ($t2 - $t1) / 60 / 60 /24;
                                        if($diff == 0)
                                        {
                                        $diff = 1;
                                        }
                                        $price_Subtotal = $room_data->price * $diff;
                                        $total_price  =   $total_price   + $price_Subtotal;
                                        echo '¥' . $price_Subtotal ;
                                      @endphp
                                    </td>
                                </tr>
                                  @php
  
                                }
                              @endphp
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>¥{{ $total_price  }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php 
  $client = 'AbE9iou3ITqq_W5ofcM_WBK7mK6BN19kFZ9URfTqLp7q2U5yxkh2rGxXXoqCBq_22-Y_o-Q4FoByr3iY';
  $final_price  = '5';
@endphp
<script>
	paypal.Button.render({
		env: 'sandbox',
		client: {
			sandbox: '{{ $client }}',
			production: '{{ $client }}'
		},
		locale: 'ja_JP',
		style: {
			size: 'medium',
			color: 'blue',
			shape: 'rect',
		},
		// Set up a payment
		payment: function (data, actions) {
			return actions.payment.create({
				redirect_urls:{
					return_url: '{{ url("payment/paypal") }}'
				},
				transactions: [{
					amount: {
						total: '{{ $final_price }}',
						currency: 'JPY'
					}
				}]
			});
		},
		// Execute the payment
		onAuthorize: function (data, actions) {
			return actions.redirect();
		}
	}, '#paypal-button');
</script>
@endsection