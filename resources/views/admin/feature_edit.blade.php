@extends('admin.layout.app')

@section('heading', 'Edit Feature')

@section('right_top_button')
<a href="{{ route('admin_feature_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_feature_update',$feature_data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">古いアイコン</label>
                                    <div>
                                        <i class="{{ $feature_data->icon }} fz_40"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新しいアイコン</label>
                                    <input type="text" class="form-control" name="icon" value="{{ $feature_data->icon }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">見出しタイトル</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $feature_data->heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">本文</label>
                                    <textarea name="text" class="form-control h_100" cols="30" rows="10">{{ $feature_data->text }}</textarea>
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