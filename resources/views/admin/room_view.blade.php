@extends('admin.layout.app')

@section('heading', 'View Rooms')

@section('right_top_button')
<a href="{{ route('admin_room_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>追加</a>
@endsection

@section('main_content')

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Amenities</th>
                                <th>Featured_photo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($rooms as $row)
                                @php $i++ @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->amenities }}</td>
                                <td>{{ $row->featured_photo }}</td>
                                <td class="pt_10 pb_10">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}">
                                        Detail
                                    </button>
                                    <a href="{{ route('admin_room_gallery',$row->id) }}" class="btn btn-success">Gallery</a>
                                    <a href="{{ route('admin_room_edit', $row->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('admin_room_delete', $row->id) }}" class="btn btn-danger" onClick="return confirm('本当に削除しますか?');">Delete</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">お部屋詳細</h5>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">画像</label></div>
                                                <div class="col-md-8">
                                                    <img src="{{ asset('uploads/' .$row->featured_photo) }}" alt="" class="w_200">
                                                </div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">名前</label></div>
                                                <div class="col-md-8">{{ $row->name }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">詳細</label></div>
                                                <div class="col-md-8">{!! $row->description !!}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">お値段</label></div>
                                                <div class="col-md-8">{{ $row->price }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">部屋数</label></div>
                                                <div class="col-md-8">{{ $row->total_rooms }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">アメニティ</label></div>
                                                <div class="col-md-8">
                                                    @if(!empty($row->amenities))
                                                    @php 
                                                      $num_arr = explode(',',$row->amenities);
                                                     for($j = 0; $j < count($num_arr); $j++){
                                                      $amenities = \App\Models\Amenity::where('id',
                                                       $num_arr[$j])->first();
                                                       echo '・'.$amenities->name.'<br>';
                                                     }
                                                    @endphp
                                                    @else 
                                                      <div class="col-md-8">・アメニティはありません</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">広さ</label></div>
                                                <div class="col-md-8">{{ $row->size }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">ベッド数</label></div>
                                                <div class="col-md-8">{{ $row->total_beds }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">バスルーム数</label></div>
                                                <div class="col-md-8">{{ $row->total_bathrooms }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">バルコニー数</label></div>
                                                <div class="col-md-8">{{ $row->total_balconies }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">定員</label></div>
                                                <div class="col-md-8">{{ $row->total_guests }}</div>
                                            </div>
                                            <div class="form-group row bdb1 pt_10 mb_0">
                                                <div class="col-md-4"><label class="form-label">youtube Video_id</label></div>
                                                <div class="col-md-8">
                                                    <div class="iframe-container1">
                                                        <iframe class="w_200" 
                                                        src="https://www.youtube.com/embed/{{ $row->video_id }}" title="YouTube video player" frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection