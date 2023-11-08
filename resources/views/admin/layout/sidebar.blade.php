<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_home') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_home') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard" ><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Setting"><i class="fa fa-cog"></i> <span>Setting</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/amenity/view') ||  Request::is('admin/room/view')   ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-superpowers"></i><span>Hotel Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/amenity/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenity_view') }}"><i class="fa fa-angle-right"></i>Amenities</a></li>
                    <li class="{{ Request::is('admin/room/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_room_view') }}"><i class="fa fa-angle-right"></i>Rooms</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/datewise-rooms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_datewise_rooms') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Datewise Rooms"><i class="fa fa-calendar"></i> <span>Datewise Rooms</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/page/about') ||  Request::is('admin/page/terms') || Request::is('admin/page/privacy') || Request::is('admin/page/contact') || Request::is('admin/page/photo-gallery') || Request::is('admin/page/video-gallery') || Request::is('admin/page/faq') || Request::is('admin/page/blog') || Request::is('admin/page/room') || Request::is('admin/page/cart') || Request::is('admin/page/checkout') || Request::is('admin/page/payment') || Request::is('admin/page/signup') || Request::is('admin/page/signin') || Request::is('admin/page/forget-password')  || Request::is('admin/page/reset-password') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-arrows"></i><span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_about') }}"><i class="fa fa-angle-right"></i>About</a></li>
                    <li class="{{ Request::is('admin/page/terms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_terms') }}"><i class="fa fa-angle-right"></i>Terms and Conditions</a></li>
                    <li class="{{ Request::is('admin/page/privacy') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_privacy') }}"><i class="fa fa-angle-right"></i>Privacy Policy</a></li>
                    <li class="{{ Request::is('admin/page/contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_contact') }}"><i class="fa fa-angle-right"></i>Contact</a></li>
                    <li class="{{ Request::is('admin/page/photo-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_photo_gallery') }}"><i class="fa fa-angle-right"></i>Photo_Gallery</a></li>
                    <li class="{{ Request::is('admin/page/video-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_video_gallery') }}"><i class="fa fa-angle-right"></i>Video_Gallery</a></li>
                    <li class="{{ Request::is('admin/page/faq') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_faq') }}"><i class="fa fa-angle-right"></i>FAQ</a></li>
                    <li class="{{ Request::is('admin/page/blog') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_blog') }}"><i class="fa fa-angle-right"></i>Blog</a></li>
                    <li class="{{ Request::is('admin/page/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_room') }}"><i class="fa fa-angle-right"></i>Room</a></li>
                    <li class="{{ Request::is('admin/page/cart') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_cart') }}"><i class="fa fa-angle-right"></i>Cart</a></li>
                    <li class="{{ Request::is('admin/page/checkout') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_checkout') }}"><i class="fa fa-angle-right"></i>Checkout</a></li>
                    <li class="{{ Request::is('admin/page/payment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_payment') }}"><i class="fa fa-angle-right"></i>Payment</a></li>
                    <li class="{{ Request::is('admin/page/signup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_signup') }}"><i class="fa fa-angle-right"></i>Signup</a></li>
                    <li class="{{ Request::is('admin/page/signin') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_signin') }}"><i class="fa fa-angle-right"></i>Signin</a></li>
                    <li class="{{ Request::is('admin/page/forget-password') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_forget_password') }}"><i class="fa fa-angle-right"></i>ForgetPassword</a></li>
                    <li class="{{ Request::is('admin/page/reset-password') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_reset_password') }}"><i class="fa fa-angle-right"></i>ResetPassword</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/customers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_customer') }}"><i class="fa fa-user-plus" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Customer"></i> <span>Customers</span></a></li>
            <li class="{{ Request::is('admin/order/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_orders') }}"><i class="fa fa-cart-plus" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Order"></i> <span>Orders</span></a></li>
            <li class="{{ Request::is('admin/slide/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slide_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Slide"><i class="fa fa-cubes"></i> <span>Slide</span></a></li>
            <li class="{{ Request::is('admin/feature/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Feature"><i class="fa fa-gavel"></i> <span>Feature</span></a></li>
            <li class="{{ Request::is('admin/testimonila/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Testimonial"><i class="fa fa-briefcase"></i> <span>Testimonila</span></a></li>
            <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Post"><i class="fa fa-clipboard"></i> <span>Post</span></a></li>
            <li class="{{ Request::is('admin/photo/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Photo"><i class="fa fa-picture-o"></i> <span>Photo Gallery</span></a></li>
            <li class="{{ Request::is('admin/video/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Video"><i class="fa fa-camera"></i> <span>Video Gallery</span></a></li>
            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="FAQ"><i class="fa fa-bolt"></i> <span>FAQ</span></a></li>
        </ul>
    </aside>
</div>