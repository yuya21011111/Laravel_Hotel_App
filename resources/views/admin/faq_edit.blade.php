@extends('admin.layout.app')

@section('heading', 'Edit FAQ')

@section('right_top_button')
<a href="{{ route('admin_faq_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i>一覧</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_faq_update',$faq_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">よくある質問</label>
                                    <input type="text" class="form-control" name="question" value="{{ $faq_data->question }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">答え</label>
                                    <textarea  class="form-control snote" cols="30" rows="10" name="answer" >{{ $faq_data->answer }}</textarea>
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