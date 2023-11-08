@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page->contact_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="contact-form">
                    <div class="mb-3">
                        <label for="" class="form-label">名前</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">メールアドレス</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">メッセージ</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary bg-website">送信</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="map">
                    {!! $page->contact_map !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection