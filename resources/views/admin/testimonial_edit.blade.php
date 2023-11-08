@extends('admin.layout.app')

@section('heading', 'Edit Testimonial')

@section('right_top_button')
<a href="{{ route('admin_testimonial_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_testimonial_update',$testimonial_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">古い画像</label>
                                    <div>
                                    <img src="{{ asset('uploads/' . $testimonial_data->photo) }}" alt="" class="w_400">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新しい画像</label>
                                    <div>
                                     <input type="file" name="photo">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">名前</label>
                                    <input type="text" class="form-control" name="name" value="{{ $testimonial_data->name }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">役職</label>
                                    <textarea name="designation" class="form-control h_100" cols="30" rows="10">{{ $testimonial_data->designation }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">コメント</label>
                                    <input type="text" class="form-control" name="comment" value="{{ $testimonial_data->comment }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">送信</button>
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