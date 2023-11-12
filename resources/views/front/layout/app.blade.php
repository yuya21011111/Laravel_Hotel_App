<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <title>Hotel Website</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/' . $global_setting_data->favicon) }}">


    <!-- front.styles -->
    @include('front.layout.styles')
    <!-- front.scripts -->
    @include('front.layout.scripts')

    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500&display=swap" rel="stylesheet">

    <!-- Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-84213520-6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-84213520-6');
        </script>  --}}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $global_setting_data->analytic_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', {{ $global_setting_data->analytic_id }});
    </script>

   <style>
   
         .main-nav nav .navbar-nav .nav-item a:hover,
         .main-nav nav .navbar-nav .nav-item:hover a,
         .slide-carousel.owl-carousel .owl-nav .owl-prev:hover, 
         .slide-carousel.owl-carousel .owl-nav .owl-next:hover,
         .home-feature .inner .icon i,
         .home-rooms .inner .text .price,
         .home-rooms .inner .text .button a,
         .blog-item .inner .text .button a,
         .room-detail-carousel.owl-carousel .owl-nav .owl-prev:hover, 
         .room-detail-carousel.owl-carousel .owl-nav .owl-next:hover  {
            color: {{ $global_setting_data->theme_color_1  }};
         }

         .main-nav nav .navbar-nav .nav-item .dropdown-menu li a:hover,
         .primary-color {
            color: {{ $global_setting_data->theme_color_1  }}!important;
         }

         .testimonial-carousel .owl-dots .owl-dot,
         .footer ul.social li a,
         .scroll-top{
            background-color: {{ $global_setting_data->theme_color_1  }};
         }

         .slider .text .button a,
         .search-section button[type="submit"],
         .home-rooms .big-button a,
         .blog-item .inner .text .button a,
         .bg-website,
         .room-detail .right .widget .book-now {
            background-color: {{ $global_setting_data->theme_color_1  }}!important;
         }

         .slide-carousel.owl-carousel .owl-nav .owl-prev:hover, 
         .slide-carousel.owl-carousel .owl-nav .owl-next:hover,
         .search-section button[type="submit"],
         .slider .text .button a,
         .room-detail-carousel.owl-carousel .owl-nav .owl-prev:hover, 
         .room-detail-carousel.owl-carousel .owl-nav .owl-next:hover,
         .room-detail .amenity .item{
            border-color: {{ $global_setting_data->theme_color_1  }}!important;
         }

         .home-feature .inner .icon i,
         .home-rooms .inner .text .button a,
         .blog-item .inner .text .button a,
         .room-detail .amenity .item,
         .cart .table-cart tr th {
            background-color: {{ $global_setting_data->theme_color_2  }}!important;
         }


   </style>

</head>

<body>

    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 left-side">
                    <ul>
                        @if (trim($global_setting_data->top_bar_phone) !== '' || $global_setting_data->top_bar_phone !== null)
                            <li class="phone-text">{{ $global_setting_data->top_bar_phone }}</li>
                        @endif

                        @if (trim($global_setting_data->top_bar_email) !== '' || $global_setting_data->top_bar_email !== null)
                            <li class="email-text">{{ $global_setting_data->top_bar_email }}</li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-6 right-side">
                    <ul class="right">
                        @if ($global_page_data->cart_status == 1)
                            <li class="menu"><a href="{{ route('cart') }}">Cart @if (session()->get('cart_room_id'))
                                        <sup>{{ count(session()->get('cart_room_id')) }}</sup>
                                    @endif
                                </a></li>
                        @endif

                        @if ($global_page_data->checkout_status == 1)
                            <li class="menu"><a href="{{ route('checkout') }}">Checkout</a></li>
                        @endif
                        @if (!Auth::guard('customer')->check())
                            @if ($global_page_data->signup_status == 1)
                                <li class="menu"><a href="{{ route('customer_signup') }}">Sign Up</a></li>
                            @endif

                            @if ($global_page_data->signin_status == 1)
                                <li class="menu"><a href="{{ route('customer_login') }}">Login</a></li>
                            @endif
                        @else
                            <li class="menu"><a href="{{ route('customer_home') }}">Dashboard</a></li>
                        @endif
                        <li class="menu"><a class="text-danger" href="{{ route('admin_login') }}">Admin</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="navbar-area" id="stickymenu">

        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('uploads/' . $global_setting_data->logo) }}" alt="">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('uploads/' . $global_setting_data->logo) }}" alt="">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>
                            @if ($global_page_data->about_status == 1)
                                <li class="nav-item">
                                    <a href="{{ 'about' }}"
                                        class="nav-link">{{ $global_page_data->about_heading }}</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="javascript:void;" class="nav-link dropdown-toggle">Room & Suite</a>
                                <ul class="dropdown-menu">
                                    @foreach ($global_room_data as $item)
                                        <li class="nav-item">
                                            <a href="{{ route('room_detail', $item->id) }}"
                                                class="nav-link">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @if ($global_page_data->photo_gallery_status == 1 && $global_page_data->video_gallery_status == 1)
                                <li class="nav-item">
                                    <a href="javascript:void;" class="nav-link dropdown-toggle">Gallery</a>
                                    <ul class="dropdown-menu">
                                        @if ($global_page_data->photo_gallery_status == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('photo_gallery') }}" class="nav-link">Photo
                                                    Gallery</a>
                                            </li>
                                        @endif
                                        @if ($global_page_data->photo_gallery_status == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('video_gallery') }}" class="nav-link">Video
                                                    Gallery</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if ($global_page_data->blog_status == 1)
                                <li class="nav-item">
                                    <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                                </li>
                            @endif

                            @if ($global_page_data->contact_status == 1)
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}">{{ $global_page_data->contact_heading }}</a>
                                </li>
                            @endif

                            @if ($global_page_data->faq_status == 1)
                                <li class="nav-item">
                                    <a href="{{ route('faq') }}">FAQ</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- front.home -->
    @yield('main_content')

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="item">
                        <h2 class="heading">Site Links</h2>
                        <ul class="useful-links">

                            @if ($global_page_data->photo_gallery_status == 1)
                                <li><a href="{{ route('photo_gallery') }}">Photo Gallery</a></li>
                            @endif

                            @if ($global_page_data->video_gallery_status == 1)
                                <li><a href="{{ route('video_gallery') }}">Video Gallery</a></li>
                            @endif

                            @if ($global_page_data->blog_status == 1)
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                            @endif

                            @if ($global_page_data->contact_status == 1)
                                <li><a href="{{ route('contact') }}">{{ $global_page_data->contact_heading }}</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h2 class="heading">Useful Links</h2>
                        <ul class="useful-links">
                            <li><a href="index.html">Home</a></li>
                            @if ($global_page_data->terms_status == 1)
                                <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                            @endif

                            @if ($global_page_data->privacy_status == 1)
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            @endif
                            @if ($global_page_data->faq_status == 1)
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                            @endif
                        </ul>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <h2 class="heading">Contact</h2>
                        <div class="list-item">
                            <div class="left">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="right">
                                {!! nl2br($global_setting_data->footer_bar_address) !!}
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="left">
                                <i class="fa fa-volume-control-phone"></i>
                            </div>
                            <div class="right">
                                {{ $global_setting_data->footer_bar_email }}
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="left">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="right">
                                {{ $global_setting_data->footer_bar_phone }}
                            </div>
                        </div>
                        <ul class="social">
                            @if (trim($global_setting_data->facebook) !== '' || $global_setting_data->facebook !== null)
                                <li><a href="{{ $global_setting_data->facebook }}"><i
                                            class="fa fa-facebook-f"></i></a></li>
                            @endif

                            @if (trim($global_setting_data->twitter) !== '' || $global_setting_data->twitter !== null)
                                <li><a href="{{ $global_setting_data->twitter }}"><i class="fa fa-twitter"></i></a>
                                </li>
                            @endif

                            @if (trim($global_setting_data->github) !== '' || $global_setting_data->github !== null)
                                <li><a href="{{ $global_setting_data->github }}"><i class="fa fa-github"></i></a>
                                </li>
                            @endif

                            {{-- <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-instagram"></i></a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="item">
                        <h2 class="heading">Newsletter</h2>
                        <p>
                            In order to get the latest news and other great items, please subscribe us here:
                        </p>
                        {{-- <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Subscribe Now">
                                </div>
                            </form> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        {{ $global_setting_data->copyright }}
    </div>

    <div class="scroll-top">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- front.scripts_footer -->
    @include('front.layout.scripts_footer')


    {{-- <script>
        $(function(){
          moment.locale("ja");
          $('#date_format').daterangepicker(
            {
              ranges: {
                '今日': [moment(), moment()],
                '昨日': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '過去7日間': [moment().subtract(6, 'days'), moment()],
                '過去30日間': [moment().subtract(29, 'days'), moment()],
                '今月': [moment().startOf('month'), moment().endOf('month')],
                '先月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment(),
              format: "YYYY-MM-DD",
              locale: { applyLabel: "OK", customRangeLabel: "カスタム"}
            },
            function (start, end) {
              console.log(start);
              $('#date').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
          );
        });
      </script> --}}
    <script>
        // 日本語に設定
        moment.locale('ja');

        // カレンダーを日本語化
        $('#date_format').daterangepicker({
            "locale": {
                "monthNames": ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                "format": "YYYY-MM-DD",
                "daysOfWeek": ['日', '月', '火', '水', '木', '金', '土'],
                "separator": " - ",
                "applyLabel": "適用",
                "cancelLabel": "キャンセル",
            }
        });
    </script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif

    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('success') }}',
            });
        </script>
    @endif

    @if (session()->get('error'))
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('error') }}',
            });
        </script>
    @endif
</body>

</html>
