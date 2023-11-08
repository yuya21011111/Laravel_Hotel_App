@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->signin_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <form action="{{ route('customer_login_submit') }}" method="POST">
                    @csrf
                <div class="login-form">
                    <div class="mb-3">
                        <label for="" class="form-label">メールアドレス</label>
                        <input type="text" class="form-control" name="email">
                        @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                         @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">パスワード</label>
                        <input type="password" class="form-control" name="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary bg-website">ログイン</button>
                        <a href="{{ route('customer_forget_password') }}" class="primary-color">パスワードをお忘れですか?</a>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('customer_signup') }}" class="primary-color">新規登録</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection