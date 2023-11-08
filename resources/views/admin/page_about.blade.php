@extends('admin.layout.app')

@section('heading', 'Edit About Page')
@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page_about_update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">見出しタイトル</label>
                                    <div>
                                     <input type="text" class="form-control" name="about_heading" value="{{ $page_data->about_heading }}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">コンタクト</label>
                                    <textarea class="form-control snote" cols="30" rows="10"  name="about_content">{{ $page_data->about_content }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">ステータス</label>
                                    <select name="about_status" class="form-control">
                                        <option value="1" @if($page_data->about_status == 1) selected @endif>表示</option>
                                        <option value="0" @if($page_data->about_status == 0) selected  @endif >非表示</option>
                                    </select>
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