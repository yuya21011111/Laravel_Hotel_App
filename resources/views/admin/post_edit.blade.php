@extends('admin.layout.app')

@section('heading', 'Edit Post')

@section('right_top_button')
<a href="{{ route('admin_post_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_post_update',$post_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">古い画像</label>
                                    <div>
                                    <img src="{{ asset('uploads/' . $post_data->photo) }}" alt="" class="w_400">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新しい画像</label>
                                    <div>
                                     <input type="file" name="photo">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">見出しタイトル</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $post_data->heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">本文１</label>
                                    <textarea name="short_content" class="form-control h_100" cols="30" rows="10">{{ $post_data->short_content }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">本文２</label>
                                    <textarea type="text" class="form-control snote" name="content">{{ $post_data->content }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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