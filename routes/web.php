<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PayPalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/404', [HomeController::class, 'error_page']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);

//danh muc san pham
Route::get('/danh-muc-san-pham/{category_slug}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_slug}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_slug}', [ProductController::class, 'details_product']);
Route::get('/danh-muc/{category_slug}', [CategoryProduct::class, 'show_category_parent']);





// backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
//categoryproduct
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/export-csv', [CategoryProduct::class, 'export_csv']);
Route::post('/import-csv', [CategoryProduct::class, 'import_csv']);


Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

//BrandProduct
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);


//Product
Route::group(['middleware' => 'auth.roles'], function () {
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
    Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
});
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/tag/{product_id}', [ProductController::class, 'tag']);


Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);

Route::post('/delete-document', [ProductController::class, 'delete_document']);

//cart

Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/delete-product-ajax/{session_id}', [CartController::class, 'delete_product_ajax']);
Route::get('/del-all-product', [CartController::class, 'delete_all_product']);
Route::get('/show-cart', [CartController::class, 'show_cart_menu']);
Route::get('/hover-cart', [CartController::class, 'hover_cart']);
Route::get('/remove-item', [CartController::class, 'remove_item']);
Route::get('/cart-session', [CartController::class, 'cart_session']);
Route::get('/show-quick-cart', [CartController::class, 'show_quick_cart']);
Route::post('/update-quick-cart', [CartController::class, 'update_quick_cart']);



//coupon

Route::post('/check-coupon', [CartController::class, 'check_coupon']);

Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);


//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);

//don hang order

Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
Route::post('/update-qty', [OrderController::class, 'update_qty']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'delete_order']);
Route::post('/huy-don-hang', [OrderController::class, 'huy_don_hang']);


Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

Route::get('/login-google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);

// delivery
Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery']);

Route::get('/del-fee', [CheckoutController::class, 'del_fee']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);


//slider
Route::get('/manage-slider', [SliderController::class, 'manage_slider']);
Route::get('/add-slider', [SliderController::class, 'add_slider']);
Route::post('/insert-slider', [SliderController::class, 'insert_slider']);
Route::get('/unactive-slide/{slide_id}', [SliderController::class, 'unactive_slide']);
Route::get('/active-slide/{slide_id}', [SliderController::class, 'active_slide']);
Route::get('/delete-slide/{slide_id}', [SliderController::class, 'delete_slide']);

//Authentication roles

Route::get('/register-auth', [AuthController::class, 'register_auth']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login-auth', [AuthController::class, 'login_auth']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout-auth', [AuthController::class, 'logout_auth']);

//user
Route::get('/users', [UserController::class, 'index'])->middleware('auth.roles');
Route::post('/assign-roles', [UserController::class, 'assign_roles'])->middleware('auth.roles');
Route::get('/add-users', [UserController::class, 'add_users'])->middleware('auth.roles');
Route::get('/delete-user-roles/{admin_id}', [UserController::class, 'delete_user_roles'])->middleware('auth.roles');
Route::post('/store-users', [UserController::class, 'store_users'])->middleware('auth.roles');
Route::get('/impersonate/{admin_id}', [UserController::class, 'impersonate']);
Route::get('/impersonate-destroy', [UserController::class, 'impersonate_destroy']);
//Category-post
Route::get('/add-category-post', [CategoryPost::class, 'add_category_post']);
Route::get('/all-category-post', [CategoryPost::class, 'all_category_post']);
Route::post('/save-category-post', [CategoryPost::class, 'save_category_post']);
Route::get('/danh-muc-bai-viet/{post_slug}', [PostController::class, 'danh_muc_bai_viet']);
Route::get('/edit-cate-post/{cate_post_id}', [CategoryPost::class, 'edit_cate_post']);
Route::post('/update-cate-post/{cate_post_id}', [CategoryPost::class, 'update_category_post']);
Route::get('/delete-cate-post/{cate_post_id}', [CategoryPost::class, 'delete_cate_post']);


//Post
Route::get('/add-post', [PostController::class, 'add_post']);
Route::post('/save-post', [PostController::class, 'save_post']);
Route::get('/all-post', [PostController::class, 'all_post']);
Route::get('/delete-post/{post_id}', [PostController::class, 'delete_post']);
Route::get('/edit-post/{post_id}', [PostController::class, 'edit_post']);
Route::get('/danh-muc-bai-viet/{cate_post_slug}', [PostController::class, 'danh_muc_bai_viet']);
Route::post('/update-post/{post_id}', [PostController::class, 'update_post']);
Route::get('/bai-viet/{post_slug}', [PostController::class, 'bai_viet']);

//gallery
Route::get('/add-gallery/{product_id}', [GalleryController::class, 'add_gallery']);
Route::post('/select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('/insert-gallery/{pro_id}', [GalleryController::class, 'insert_gallery']);
Route::post('/update-gallery-name', [GalleryController::class, 'update_gallery_name']);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);
Route::post('/update-gallery', [GalleryController::class, 'update_gallery']);

//video
Route::get('/video', [VideoController::class, 'video']);
Route::post('/select-video', [VideoController::class, 'select_video']);
Route::post('/insert-video', [VideoController::class, 'insert_video']);
Route::post('/update-video', [VideoController::class, 'update_video']);
Route::post('/delete-video', [VideoController::class, 'delete_video']);
Route::get('/video-shop', [VideoController::class, 'video_shop']);

Route::post('/update-video-image', [VideoController::class, 'update_video_image']);
Route::post('/watch-video', [VideoController::class, 'watch_video']);


Route::post('/autocomplete-ajax', [HomeController::class, 'autocomplete_ajax']);
Route::post('/load-more-product', [HomeController::class, 'load_more_product']);




Route::post('/quickview', [ProductController::class, 'quickview']);
//comment
Route::post('/load-comment', [CommentController::class, 'load_comment']);
Route::post('/send-comment', [CommentController::class, 'send_comment']);

Route::get('/comment', [CommentController::class, 'list_comment']);
Route::post('/allow-comment', [CommentController::class, 'allow_comment']);
Route::post('/reply-comment', [CommentController::class, 'reply_comment']);
Route::post('/insert-comment', [CommentController::class, 'insert_comment']);

//contact
Route::get('/lien-he', [ContactController::class, 'lien_he']);
Route::get('/information', [ContactController::class, 'information']);
Route::post('/save-info', [ContactController::class, 'save_info']);
Route::post('/update-info/{info_id}', [ContactController::class, 'update_info']);
Route::get('/list-nut', [ContactController::class, 'list_nut']);
Route::get('/delete-icons', [ContactController::class, 'delete_icons']);
Route::post('/add-nut', [ContactController::class, 'add_nut']);
Route::post('/add-doitac', [ContactController::class, 'add_doitac']);
Route::get('/list-doitac', [ContactController::class, 'list_doitac']);
Route::get('/delete-doitac', [ContactController::class, 'delete_doitac']);


Route::get('/file-browser', [ProductController::class, 'file_browser']);
Route::post('/uploads-ckeditor', [ProductController::class, 'uploads_ckeditor']);

Route::post('/arrange-category', [CategoryProduct::class, 'arrange_category']);
Route::post('/product-tabs', [CategoryProduct::class, 'product_tabs']);



Route::post('/filter-by-day', [AdminController::class, 'filter_by_day']);

Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);

Route::post('/days-order', [AdminController::class, 'days_order']);
//document
Route::get('/create_folder', [DocumentController::class, 'create_folder']);

//Send mail
Route::get('/send-coupon-vip/{coupon_id}', [MailController::class, 'send_coupon_vip']);
Route::get('/send-coupon/{coupon_id}', [MailController::class, 'send_coupon']);
Route::get('/quen-mat-khau', [MailController::class, 'forget_password']);
Route::post('/recover-pass', [MailController::class, 'recover_pass']);
Route::get('/update-new-pass', [MailController::class, 'update_new_pass']);

Route::post('/reset-new-pass', [MailController::class, 'reset_new_pass']);

Route::get('/login-customer-google', [AdminController::class, 'login_customer_google']);
Route::get('/customer/google/callback', [AdminController::class, 'callback_customer_google']);

Route::get('/login-customer-facebook', [AdminController::class, 'login_customer_facebook']);
Route::get('/customer/facebook/callback', [AdminController::class, 'callback_customer_facebook']);

Route::post('/login-customer', [CheckoutController::class, 'login_customer']);

Route::get('/history', [OrderController::class, 'history']);
Route::get('/view-history-order/{order_code}', [OrderController::class, 'view_history_order']);


Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

Route::get('lang/locale', function ($locale) {
    if (!in_array($locale, ['en', 'vi', 'cn'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::post('/vnpay-payment', [CheckoutController::class, 'vnpay_payment']);

Route::post('/momo-payment', [CheckoutController::class, 'momo_payment']);
Route::post('/onepay-payment', [CheckoutController::class, 'onepay_payment']);

