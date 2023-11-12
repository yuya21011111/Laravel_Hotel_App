@extends('admin.layout.app')

@section('heading', 'Edit Video')

@section('right_top_button')
<a href="{{ route('admin_video_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_video_update',$video_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">old　youtube Video_id<</label>
                                    <div class="iframe-container1">
                                        <iframe class="w_200" 
                                        src="https://www.youtube.com/embed/{{ $video_data->video_id }}" title="YouTube video player" frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">New youtube Video_id</label>
                                    <input type="text" class="form-control" name="video_id" value="{{ $video_data->video_id }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">説明</label>
                                    <input type="text" class="form-control" name="caption" value="{{ $video_data->caption }}">
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