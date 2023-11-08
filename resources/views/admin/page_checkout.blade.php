@extends('admin.layout.app')

@section('heading', 'Edit Checkout Page')
@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page_checkout_update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">見出しタイトル</label>
                                    <div>
                                     <input type="text" class="form-control" name="checkout_heading" value="{{ $page_data->checkout_heading }}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">ステータス</label>
                                    <select name="checkout_status" class="form-control">
                                        <option value="1" @if($page_data->checkout_status == 1) selected @endif>表示</option>
                                        <option value="0" @if($page_data->checkout_status == 0) selected  @endif >非表示</option>
                                    </select>
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