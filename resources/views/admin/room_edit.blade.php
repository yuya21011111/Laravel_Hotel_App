@extends('admin.layout.app')

@section('heading', 'Edit Room')

@section('right_top_button')
<a href="{{ route('admin_room_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_room_update',$room_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">古い画像</label>
                                    <div>
                                    <img src="{{ asset('uploads/' . $room_data->featured_photo) }}" alt="" class="w_400">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新しい画像</label>
                                    <div>
                                     <input type="file" name="featured_photo">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">名前</label>
                                    <input type="text" class="form-control" name="name" value="{{ $room_data->name }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">詳細</label>
                                    <textarea  class="form-control snote" name="description" >{{ $room_data->description}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">お値段</label>
                                    <input type="text" class="form-control" name="price" value="{{ $room_data->price }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">部屋数</label>
                                    <input type="text" class="form-control" name="total_rooms" value="{{ $room_data->total_rooms }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">アニメティ</label>
                                    @php $i = 0;  @endphp
                                    @foreach($all_amenities as $item)
                                    @if(in_array($item->id,$existing_amenities))
                                      @php $checked_type = 'checked'; @endphp
                                    @else 
                                      @php $checked_type = ''; @endphp
                                    @endif
                                    @php $i++; @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="defaultCheck{{$i}}" name="arr_amenities[]" {{ $checked_type }}>
                                        <label class="form-check-label" for="defaultCheck{{$i}}">
                                         {{ $item->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">広さ</label>
                                    <input type="text" class="form-control" name="size" value="{{ $room_data->size }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">ベッド数</label>
                                    <input type="text" class="form-control" name="total_beds" value="{{ $room_data->total_beds }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">バスルーム数</label>
                                    <input type="text" class="form-control" name="total_bathrooms" value="{{ $room_data->total_bathrooms }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">バルコニー数</label>
                                    <input type="text" class="form-control" name="total_balconies" value="{{ $room_data->total_balconies }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">定員数</label>
                                    <input type="text" class="form-control" name="total_guests" value="{{ $room_data->total_guests }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">youtube Video Preview</label>
                                    <div class="col-md-8">
                                        <div class="iframe-container1">
                                            <iframe class="w_200" 
                                            src="https://www.youtube.com/embed/{{ $room_data->video_id }}" title="YouTube video player" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">youtube Video_id</label>
                                    <input type="text" class="form-control" name="video_id" value="{{ $room_data->video_id }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection