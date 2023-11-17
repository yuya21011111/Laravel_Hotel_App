@extends('customer.layout.app')

@section('heading', 'Invoice')

@section('main_content')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2>
                        <div class="invoice-number">Order #{{ $order->order_no }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Invoice To</strong><br>
                                {{ Auth::guard('customer')->user()->name }}<br>
                                {{ Auth::guard('customer')->user()->zip }}<br>
                                {{ Auth::guard('customer')->user()->address }}<br>
                                {{ Auth::guard('customer')->user()->state }}<br>
                                {{ Auth::guard('customer')->user()->city }}
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>Invoice Date</strong><br>
                                {{ $order->booking_date }}
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">領収書</div>
                    <p class="section-lead">ホテルの客室情報は下記の通りになります。</p>
                    <hr class="invoice-above-table">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th>No</th>
                                <th>お部屋</th>
                                <th class="text-center">Checkin Date</th>
                                <th class="text-center">Checkout Date</th>
                                <th class="text-center">大人</th>
                                <th class="text-center">子ども</th>
                                <th class="text-center">合計</th>
                            </tr>
                            @php
                               $total_price  = 0;
                            @endphp
                            @foreach($order_detail as $item)
                            @php 
                              $room_data = \App\Models\Room::where('id', $item->room_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $room_data->name }}</td>
                                <td class="text-center">{{ $item->checkin_date }}</td>
                                <td class="text-center">{{ $item->checkout_date }}</td>
                                <td class="text-center">{{ $item->adult }}</td>
                                <td class="text-center">{{ $item->children }}</td>
                                <td class="text-center">{{ $item->subtotal }}</td>
                            </tr>
                            @php 
                            $d1 = explode('-',$item->checkin_date);
                            $d2 = explode('-',$item->checkout_date);
                            $d1_new = $d1[0].'-'.$d1[1].'-'.$d1[2];
                            $d2_new = $d2[0].'-'.$d2[1].'-'.$d2[2];
                            $t1 = strtotime($d1_new);
                            $t2 =  strtotime($d2_new);
                            $diff = ($t2 - $t1) / 60 / 60 /24;
                            $price_Subtotal = $room_data->price * $diff;
                            $total_price  =   $total_price   + $price_Subtotal;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">合計</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">
                                    ¥{{ $total_price }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="about-print-button">
        <div class="text-md-right">
            <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>
</div>
@endsection