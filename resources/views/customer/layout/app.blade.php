<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <title>Customer Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('customer.layout.styles')
    @include('customer.layout.scripts')

</head>

<body>
<div id="app">
    <div class="main-wrapper">

        @include('customer.layout.nav')        
        @include('customer.layout.sidebar')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('heading')</h1>
                    <div class="ml-auto">
                        @yield('right_top_button')
                    </div>
                </div>
                @yield('main_content')
    </div>
</div>

@include('customer.layout.scripts_footer')

@if($errors->any())
  @foreach($errors->all() as $error)
  <script>
  iziToast.error({
    title: '',
    position: 'topRight',
    message: '{{ $error }}',
   });
   </script>
  @endforeach
@endif

@if(session()->get('success'))
  <script>
    iziToast.success({
    title: '',
    position: 'topRight',
    message: '{{ session()->get('success') }}',
   });
  </script>
@endif
<script>
$('#example1').DataTable( {
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Japanese.json"
    }
} );
</script>

</body>
</html>