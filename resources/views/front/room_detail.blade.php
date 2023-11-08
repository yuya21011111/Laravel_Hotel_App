@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$single_room_data->name }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content room-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 left">

                <div class="room-detail-carousel owl-carousel">
                    <div class="item" style="background-image:url({{ asset('uploads/'.$single_room_data->featured_photo) }});">
                        <div class="bg"></div>
                    </div>

                    @foreach($single_room_data->rRoomPhoto as $item)
                    <div class="item" style="background-image:url({{ asset('uploads/'.$item->photo) }});">
                        <div class="bg"></div>
                    </div>
                    @endforeach
                </div>
                
                <div class="description">
                   {!! $single_room_data->description !!}
                </div>

                <div class="amenity">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Amenities</h2>
                        </div>
                    </div>
                    <div class="row">
                        @if(!empty($single_room_data->amenities))
                        @php 
                          $num_arr = explode(',',$single_room_data->amenities);
                         for($j = 0; $j < count($num_arr); $j++){
                          $amenities = \App\Models\Amenity::where('id',
                           $num_arr[$j])->first();
                           echo '<div class="col-lg-6 col-md-12">';
                           echo '<div class="item"><i class="fa fa-check-circle"></i>'.$amenities->name.'</div>';
                           echo '</div>';
                         }
                        @endphp
                        @else 
                        <div class="col-lg-6 col-md-12">
                            <div class="item"><i class="fa fa-check-circle"></i>アメニティはありません</div>
                        </div>
                        @endif
                    </div>
                </div>


                <div class="feature">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Features</h2>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>広さ</th>
                                <td>{{ $single_room_data->size }}</td>
                            </tr>
                            <tr>
                                <th>ベッド数</th>
                                <td>{{ $single_room_data->total_beds }}</td>
                            </tr>
                            <tr>
                                <th>バスルーム数</th>
                                <td>{{  $single_room_data->total_bathrooms }}</td>
                            </tr>
                            <tr>
                                <th>バルコニー数</th>
                                <td>{{  $single_room_data->total_balconies }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if(trim($single_room_data->video_id) !== '' || $single_room_data->video_id !== null)
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{  $single_room_data->video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                @endif


            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 right">

                <div class="sidebar-container" id="sticky_sidebar">

                        <div class="widget">
                            <h2>お部屋価格</h2>
                            <div class="price">
                                ¥{{ $single_room_data->price }}
                            </div>
                        </div>
                        <div class="widget">
                            <h2>予約</h2>
                            <form action="{{ route('cart_submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $single_room_data->id }}">
                            <div class="form-group mb_20">
                                <label for="">Check in & Check out</label>
                                <input type="text" name="checkin_checkout" class="form-control daterange1" id="date_format" placeholder="Checkin & Checkout">
                            </div>
                            <div class="form-group mb_20">
                                <label for="">大人</label>
                                <input type="number" name="adult" class="form-control" min="1" max="30" placeholder="大人">
                            </div>
                            <div class="form-group mb_20">
                                <label for="">子ども</label>
                                <input type="number" name="children" class="form-control" min="0" max="30" placeholder="子ども">
                            </div>
                            <button type="submit" class="book-now">予約する</button>
                            </form>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection