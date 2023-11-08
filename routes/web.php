<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AdminCustomerController;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\AboutController;
use App\Http\Controllers\front\BlogController;
use App\Http\Controllers\admin\AdminSlideController;
use App\Http\Controllers\admin\AdminFeatureController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\admin\AdminTestimonialController;
use App\Http\Controllers\admin\AdminPhotoController;
use App\Http\Controllers\front\PhotoController;
use App\Http\Controllers\admin\AdminVideoController;
use App\Http\Controllers\front\VideoController;
use App\Http\Controllers\admin\AdminFaqController;
use App\Http\Controllers\front\FaqController;
use App\Http\Controllers\admin\AdminPageController;
use App\Http\Controllers\front\TermsController;
use App\Http\Controllers\front\PrivacyController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\admin\AdminAmenityController;
use App\Http\Controllers\admin\AdminRoomController;
use App\Http\Controllers\admin\AdminSettingController;
use App\Http\Controllers\front\RoomController;

use App\Http\Controllers\customer\CustomerHomeController;
use App\Http\Controllers\customer\CustomerLoginController;
use App\Http\Controllers\customer\CustomerProfileController;
use App\Http\Controllers\front\BookingController;
use App\Http\Controllers\customer\CustomerOrderController;
use App\Http\Controllers\admin\AdminDatewiseRoomController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Front
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/post/{id}', [BlogController::class, 'single_post'])->name('post');
Route::get('/photo_gallery',[PhotoController::class,'index'])->name('photo_gallery');
Route::get('/video_gallery',[VideoController::class,'index'])->name('video_gallery');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/terms-and-conditions',[TermsController::class,'index'])->name('terms');
Route::get('/privacy-policy',[PrivacyController::class,'index'])->name('privacy');
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::get('/room', [RoomController::class, 'index'])->name('room');
Route::get('/room/{id}', [RoomController::class, 'single_room'])->name('room_detail');
Route::post('/booking/submit', [BookingController::class, 'cart_submit'])->name('cart_submit');
Route::get('/cart', [BookingController::class, 'cart_view'])->name('cart');
Route::get('/cart/delete/{id}', [BookingController::class, 'cart_delete'])->name('cart_delete');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/payment', [BookingController::class, 'payment'])->name('payment');
Route::get('/payment/paypal', [BookingController::class, 'paypal'])->name('paypal');

Route::post('/payment/stripe/{price}',[BookingController::class, 'stripe'])->name('stripe');

// Customer
Route::get('/login',[CustomerLoginController::class,'login'])->name('customer_login');
Route::get('/customer/logout',[CustomerLoginController::class,'logout'])->name('customer_logout');
Route::post('/login-submit',[CustomerLoginController::class, 'login_submit'])->name('customer_login_submit');
Route::get('/signup',[CustomerLoginController::class,'signup'])->name('customer_signup');
Route::post('/signup-submit',[CustomerLoginController::class,'signup_submit'])->name('customer_signup_submit');
Route::get('/forget-password',[CustomerLoginController::class,'forget_password'])->name('customer_forget_password');
Route::post('/forget-password-submit',[CustomerLoginController::class, 'forget_password_submit'])->name('customer_forget_password_submit');
Route::get('/reset-password/{token}/{email}',[CustomerLoginController::class, 'reset_password'])->name('customer_reset_password');
Route::post('/reset-password-submit',[CustomerLoginController::class, 'reset_password_submit'])->name('customer_reset_password_submit');

Route::group(['middleware' => ['customer:customer']], function(){
    Route::get('/customer/home',[CustomerHomeController::class,'index'])->name('customer_home');
    Route::get('/customer/edit-profile',[CustomerProfileController::class,'index'])->name('customer_profile');
    Route::post('/customer/edit-profile-submit',[CustomerProfileController::class,'profile_submit'])->name('customer_profile_submit');

    Route::get('/customer/order/view',[CustomerOrderController::class,'index'])->name('customer_order_view');
    Route::get('/customer/invoice/{id}',[CustomerOrderController::class,'invoice'])->name('customer_invoice');
});

// Admin
Route::get('/admin/home',[AdminHomeController::class,'index'])->name('admin_home')->middleware('admin:admin');
Route::get('/admin/setting',[AdminSettingController::class,'index'])->name('admin_setting')->middleware('admin:admin');
Route::post('/admin/setting/update/{id}',[AdminSettingController::class,'update'])->name('admin_setting_update')->middleware('admin:admin');

Route::get('/admin/datewise-rooms',[AdminDatewiseRoomController::class,'index'])->name('admin_datewise_rooms')->middleware('admin:admin');
Route::post('/admin/datewise-rooms/update',[AdminDatewiseRoomController::class,'show'])->name('admin_datewise_rooms_submit')->middleware('admin:admin');

Route::get('/admin/customers',[AdminCustomerController::class,'index'])->name('admin_customer')->middleware('admin:admin');
Route::get('/admin/customers/change-status/{id}',[AdminCustomerController::class,'change_status'])->name('admin_customer_change_status')->middleware('admin:admin');
Route::get('/admin/order/view',[AdminOrderController::class,'index'])->name('admin_orders')->middleware('admin:admin');
Route::get('/admin/order/invoice/{id}',[AdminOrderController::class,'invoice'])->name('admin_invoice')->middleware('admin:admin');
Route::get('/admin/order/delete/{id}',[AdminOrderController::class,'delete'])->name('admin_order_delete');


Route::get('/admin/login',[AdminLoginController::class,'index'])->name('admin_login');
Route::get('/admin/logout',[AdminLoginController::class,'logout'])->name('admin_logout');
Route::post('/admin/login-submit',[AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/forget-password',[AdminLoginController::class,'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit',[AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}',[AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit',[AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::group(['middleware' => ['admin:admin']], function(){
    Route::get('/admin/edit-profile',[AdminProfileController::class,'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit',[AdminProfileController::class,'profile_submit'])->name('admin_profile_submit');

    // Admin/Slide
    Route::get('/admin/slide/view',[AdminSlideController::class,'index'])->name('admin_slide_view');
    Route::get('/admin/slide/add',[AdminSlideController::class,'add'])->name('admin_slide_add');
    Route::post('/admin/slide/store',[AdminSlideController::class,'store'])->name('admin_slide_store');
    Route::get('/admin/slide/edit/{id}',[AdminSlideController::class,'edit'])->name('admin_slide_edit');
    Route::post('/admin/slide/update/{id}',[AdminSlideController::class,'update'])->name('admin_slide_update');
    Route::get('/admin/slide/delete/{id}',[AdminSlideController::class,'delete'])->name('admin_slide_delete');

    // Admin/Feature
    Route::get('/admin/feature/view',[AdminFeatureController::class,'index'])->name('admin_feature_view');
    Route::get('/admin/feature/add',[AdminFeatureController::class,'add'])->name('admin_feature_add');
    Route::post('/admin/feature/store',[AdminFeatureController::class,'store'])->name('admin_feature_store');
    Route::get('/admin/feature/edit/{id}',[AdminFeatureController::class,'edit'])->name('admin_feature_edit');
    Route::post('/admin/feature/update/{id}',[AdminFeatureController::class,'update'])->name('admin_feature_update');
    Route::get('/admin/feature/delete/{id}',[AdminFeatureController::class,'delete'])->name('admin_feature_delete');

    // Admin/Testimonila
    Route::get('/admin/testimonila/view',[AdminTestimonialController::class,'index'])->name('admin_testimonial_view');
    Route::get('/admin/testimonila/add',[AdminTestimonialController::class,'add'])->name('admin_testimonial_add');
    Route::post('/admin/testimonila/store',[AdminTestimonialController::class,'store'])->name('admin_testimonial_store');
    Route::get('/admin/testimonila/edit/{id}',[AdminTestimonialController::class,'edit'])->name('admin_testimonial_edit');
    Route::post('/admin/testimonila/update/{id}',[AdminTestimonialController::class,'update'])->name('admin_testimonial_update');
    Route::get('/admin/testimonila/delete/{id}',[AdminTestimonialController::class,'delete'])->name('admin_testimonial_delete');

    // Admin/Post
    Route::get('/admin/post/view',[AdminPostController::class,'index'])->name('admin_post_view');
    Route::get('/admin/post/add',[AdminPostController::class,'add'])->name('admin_post_add');
    Route::post('/admin/post/store',[AdminPostController::class,'store'])->name('admin_post_store');
    Route::get('/admin/post/edit/{id}',[AdminPostController::class,'edit'])->name('admin_post_edit');
    Route::post('/admin/post/update/{id}',[AdminPostController::class,'update'])->name('admin_post_update');
    Route::get('/admin/post/delete/{id}',[AdminPostController::class,'delete'])->name('admin_post_delete');

    // Admin/Photo
    Route::get('/admin/photo/view',[AdminPhotoController::class,'index'])->name('admin_photo_view');
    Route::get('/admin/photo/add',[AdminPhotoController::class,'add'])->name('admin_photo_add');
    Route::post('/admin/photo/store',[AdminPhotoController::class,'store'])->name('admin_photo_store');
    Route::get('/admin/photo/edit/{id}',[AdminPhotoController::class,'edit'])->name('admin_photo_edit');
    Route::post('/admin/photo/update/{id}',[AdminPhotoController::class,'update'])->name('admin_photo_update');
    Route::get('/admin/photo/delete/{id}',[AdminPhotoController::class,'delete'])->name('admin_photo_delete');

    // Admin/Video
    Route::get('/admin/video/view',[AdminVideoController::class,'index'])->name('admin_video_view');
    Route::get('/admin/video/add',[AdminVideoController::class,'add'])->name('admin_video_add');
    Route::post('/admin/video/store',[AdminVideoController::class,'store'])->name('admin_video_store');
    Route::get('/admin/video/edit/{id}',[AdminVideoController::class,'edit'])->name('admin_video_edit');
    Route::post('/admin/video/update/{id}',[AdminVideoController::class,'update'])->name('admin_video_update');
    Route::get('/admin/video/delete/{id}',[AdminVideoController::class,'delete'])->name('admin_video_delete');

    // Admin/Faq
    Route::get('/admin/faq/view',[AdminFaqController::class,'index'])->name('admin_faq_view');
    Route::get('/admin/faq/add',[AdminFaqController::class,'add'])->name('admin_faq_add');
    Route::post('/admin/faq/store',[AdminFaqController::class,'store'])->name('admin_faq_store');
    Route::get('/admin/faq/edit/{id}',[AdminFaqController::class,'edit'])->name('admin_faq_edit');
    Route::post('/admin/faq/update/{id}',[AdminFaqController::class,'update'])->name('admin_faq_update');
    Route::get('/admin/faq/delete/{id}',[AdminFaqController::class,'delete'])->name('admin_faq_delete');

    // Admin/Page
    Route::get('/admin/page/about',[AdminPageController::class,'about'])->name('admin_page_about');
    Route::post('/admin/page/about/update',[AdminPageController::class,'about_update'])->name('admin_page_about_update');
    Route::get('/admin/page/terms',[AdminPageController::class,'terms'])->name('admin_page_terms');
    Route::post('/admin/page/terms/update',[AdminPageController::class,'terms_update'])->name('admin_page_terms_update');

    // Admin/Privacy
    Route::get('/admin/page/privacy',[AdminPageController::class,'privacy'])->name('admin_page_privacy');
    Route::post('/admin/page/privacy/update',[AdminPageController::class,'privacy_update'])->name('admin_page_privacy_update');

    // Admin/Contact
    Route::get('/admin/page/contact',[AdminPageController::class,'contact'])->name('admin_page_contact');
    Route::post('/admin/page/contact/update',[AdminPageController::class,'contact_update'])->name('admin_page_contact_update');

    // Admin/Photo_gallery
    Route::get('/admin/page/photo-gallery',[AdminPageController::class,'photo_gallery'])->name('admin_page_photo_gallery');
    Route::post('/admin/page/photo-gallery/update',[AdminPageController::class,'photo_gallery_update'])->name('admin_page_photo_gallery_update');

   // Admin/Video_gallery
   Route::get('/admin/page/video-gallery',[AdminPageController::class,'video_gallery'])->name('admin_page_video_gallery');
   Route::post('/admin/page/video-gallery/update',[AdminPageController::class,'video_gallery_update'])->name('admin_page_video_gallery_update');

   // Admin/Faq
   Route::get('/admin/page/faq',[AdminPageController::class,'faq'])->name('admin_page_faq');
   Route::post('/admin/page/faq/update',[AdminPageController::class,'faq_update'])->name('admin_page_faq_update');

   // Admin/Blog
   Route::get('/admin/page/blog',[AdminPageController::class,'blog'])->name('admin_page_blog');
   Route::post('/admin/page/blog/update',[AdminPageController::class,'blog_update'])->name('admin_page_blog_update');

   // Admin/Room
   Route::get('/admin/page/room',[AdminPageController::class,'room'])->name('admin_page_room');
   Route::post('/admin/page/room/update',[AdminPageController::class,'room_update'])->name('admin_page_room_update');

   // Admin/Cart
   Route::get('/admin/page/cart',[AdminPageController::class,'cart'])->name('admin_page_cart');
   Route::post('/admin/page/cart/update',[AdminPageController::class,'cart_update'])->name('admin_page_cart_update');

   // Admin/Checkout
   Route::get('/admin/page/checkout',[AdminPageController::class,'checkout'])->name('admin_page_checkout');
   Route::post('/admin/page/checkout/update',[AdminPageController::class,'checkout_update'])->name('admin_page_checkout_update');

   // Admin/Payment
   Route::get('/admin/page/payment',[AdminPageController::class,'payment'])->name('admin_page_payment');
   Route::post('/admin/page/payment/update',[AdminPageController::class,'payment_update'])->name('admin_page_payment_update');

   // Admin/Signup
   Route::get('/admin/page/signup',[AdminPageController::class,'signup'])->name('admin_page_signup');
   Route::post('/admin/page/signup/update',[AdminPageController::class,'signup_update'])->name('admin_page_signup_update');

   // Admin/Admin/Signin
   Route::get('/admin/page/signin',[AdminPageController::class,'signin'])->name('admin_page_signin');
   Route::post('/admin/page/signin/update',[AdminPageController::class,'signin_update'])->name('admin_page_signin_update');

   // Admin/Admin/forget_password
   Route::get('/admin/page/forget-password',[AdminPageController::class,'forget_password'])->name('admin_page_forget_password');
   Route::post('/admin/page/forget-password/update',[AdminPageController::class,'forget_password_update'])->name('admin_page_forget_password_update');

   // Admin/Admin/reset_password
   Route::get('/admin/page/reset-password',[AdminPageController::class,'reset_password'])->name('admin_page_reset_password');
   Route::post('/admin/page/reset-password/update',[AdminPageController::class,'reset_password_update'])->name('admin_page_reset_password_update');

   // Admin/Amenity
   Route::get('/admin/amenity/view',[AdminAmenityController::class,'index'])->name('admin_amenity_view');
   Route::get('/admin/amenity/add',[AdminAmenityController::class,'add'])->name('admin_amenity_add');
   Route::post('/admin/amenity/store',[AdminAmenityController::class,'store'])->name('admin_amenity_store');
   Route::get('/admin/amenity/edit/{id}',[AdminAmenityController::class,'edit'])->name('admin_amenity_edit');
   Route::post('/admin/amenity/update/{id}',[AdminAmenityController::class,'update'])->name('admin_amenity_update');
   Route::get('/admin/amenity/delete/{id}',[AdminAmenityController::class,'delete'])->name('admin_amenity_delete');

   // Admin/Room
   Route::get('/admin/room/view',[AdminRoomController::class,'index'])->name('admin_room_view');
   Route::get('/admin/room/add',[AdminRoomController::class,'add'])->name('admin_room_add');
   Route::post('/admin/room/store',[AdminRoomController::class,'store'])->name('admin_room_store');
   Route::get('/admin/room/edit/{id}',[AdminRoomController::class,'edit'])->name('admin_room_edit');
   Route::post('/admin/room/update/{id}',[AdminRoomController::class,'update'])->name('admin_room_update');
   Route::get('/admin/room/delete/{id}',[AdminRoomController::class,'delete'])->name('admin_room_delete');
   Route::get('/admin/room/gallery/{id}',[AdminRoomController::class,'gallery'])->name('admin_room_gallery');
   Route::post('/admin/room/gallery/store/{id}',[AdminRoomController::class,'gallery_store'])->name('admin_room_gallery_store');
   Route::get('/admin/room/gallery/delete/{id}',[AdminRoomController::class,'gallery_delete'])->name('admin_room_gallery_delete');
});



