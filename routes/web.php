<?php

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
Route::get('/email','CheckoutController@send_mail');
//admin
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/admin-logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/admin-forgot-password','AdminController@admin_forgot_password');
Route::get('/admin-register/','AdminController@admin_register');
Route::post('/add-admin','AdminController@add_admin');
Route::get('/user-infor','AdminController@user_infor');
Route::post('/cap-nhat-mat-khau','AdminController@resetmk');

Route::get('/khoi-phuc-mat-khau/{admin_id}','AdminController@resetmk_admin');



//slider
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::post('/insert-slider','SliderController@insert_slider');
Route::post('/update-slider/{slider_id}','SliderController@update_slider')->name('updateSlider');

//banner
Route::get('/manage-banner','BannerController@manage_banner');
Route::get('/delete-banner/{banner_id}','BannerController@delete_banner');
Route::get('/unactive-banner/{banner_id}','BannerController@unactive_banner');
Route::get('/active-banner/{banner_id}','BannerController@active_banner');
Route::post('/insert-banner','BannerController@insert_banner');
Route::post('/update-banner/{banner_id}','BannerController@update_banner')->name('updateBanner');

//category Product
Route::get('/manage-category-product','CategoryProductController@manage_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProductController@delete_category_product');
Route::get('/unactive-category-product/{category_product_id}','CategoryProductController@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProductController@active_category_product');
Route::post('/insert-category-product','CategoryProductController@save_category_product')->name('save-category-product');
Route::post('/update-category-product/{category_product_id}','CategoryProductController@update_category_product')->name('updateCategoryProduct');


//brand Product
Route::get('/manage-brand-product','BrandProductController@manage_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProductController@delete_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}','BrandProductController@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProductController@active_brand_product');

Route::post('/insert-brand-product','BrandProductController@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProductController@update_brand_product')->name('updateBrandProduct');


//product
Route::get('/manage-product','ProductController@manage_product');

Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/unnoibat-product/{product_id}','ProductController@unnoibat_product');
Route::get('/noibat-product/{product_id}','ProductController@noibat_product');

Route::post('/save-product','ProductController@post_save_product');
Route::post('/update-product/{product_id}','ProductController@update_product')->name('updateProduct');


//customer
Route::get('/customer','CustomerController@customer');
Route::get('/unactive-customer/{customer_id}','CustomerController@unactive_customer');
Route::get('/active-customer/{customer_id}','CustomerController@active_customer');

Route::get('/delete-customer/{customer_id}','CustomerController@delete_customer');
Route::post('/insert-customer-backend','CustomerController@insert_customer_backend');

Route::post('/update-customer-backend/{customer_id}','CustomerController@update_customer_backend')->name('updateCustomer');

//staff
Route::get('/staff','StaffController@staff');
Route::get('/unactive-staff/{admin_id}','StaffController@unactive_staff');
Route::get('/active-staff/{admin_id}','StaffController@active_staff');
Route::get('/delete-staff/{admin_id}','StaffController@delete_staff');
Route::post('/insert-staff-backend','StaffController@insert_staff_backend');

Route::post('/update-staff-backend/{admin_id}','StaffController@update_staff_backend')->name('updateStaff');

//manager
Route::get('/manager','ManagerController@manager');
Route::get('/unactive-manager/{admin_id}','ManagerController@unactive_manager');
Route::get('/active-manager/{admin_id}','ManagerController@active_manager');

Route::get('/delete-manager/{admin_id}','ManagerController@delete_manager');
Route::post('/insert-manager-backend','ManagerController@insert_manager_backend');

Route::post('/update-manager-backend/{admin_id}','ManagerController@update_manager_backend')->name('updateManager');

//category post
Route::get('/manage-post','PostController@show_post');

Route::get('/delete-category-post/{category_post_id}','PostController@delete_category_post');
Route::get('/unactive-category-post/{category_post_id}','PostController@unactive_category_post');
Route::get('/active-category-post/{category_post_id}','PostController@active_category_post');

Route::post('/insert-category-post','PostController@save_category_post')->name('save-category-post');
Route::post('/update-category-post/{category_post_id}','PostController@update_category_post')->name('updateCategoryPost');

//post
Route::get('/delete-post/{post_id}','PostController@delete_post');
Route::get('/unactive-post/{post_id}','PostController@unactive_post');
Route::get('/active-post/{post_id}','PostController@active_post');
Route::get('/unnoibat-post/{post_id}','PostController@unnoibat_post');
Route::get('/noibat-post/{post_id}','PostController@noibat_post');

Route::post('/insert-post','PostController@post_save_post');
Route::post('/update-post/{post_id}','PostController@update_post')->name('updatePost');

//contact
Route::get('/manage-contact','ContactController@manage_contact');
Route::get('/unactive-contact/{contact_id}','ContactController@unactive_contact');
Route::get('/active-contact/{contact_id}','ContactController@active_contact');
Route::get('/delete-contact/{contact_id}','ContactController@delete_contact');
Route::post('/update-contact/{contact_id}','ContactController@update_contact');


//order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/delete-order/{order_id}','OrderController@delete_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
//coupon
Route::get('/coupon','CouponController@manage_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/unactive-coupon/{coupon_id}','CouponController@unactive_coupon');
Route::get('/active-coupon/{coupon_id}','CouponController@active_coupon');
Route::post('/insert-coupon','CouponController@insert_coupon');
Route::post('/update-coupon/{coupon_id}','CouponController@update_coupon')->name('updateCoupon');

//khuyenmai
Route::get('/delete-khuyenmai/{khuyenmai_id}','CouponController@delete_khuyenmai');
Route::get('/unactive-khuyenmai/{khuyenmai_id}','CouponController@unactive_khuyenmai');
Route::get('/active-khuyenmai/{khuyenmai_id}','CouponController@active_khuyenmai');
Route::post('/insert-khuyenmai','CouponController@insert_khuyenmai');
Route::post('/update-khuyenmai/{khuyenmai_id}','CouponController@update_khuyenmai')->name('updateKhuyenMai');
Route::get('/unactive-khuyenmainb/{khuyenmai_id}','CouponController@unactive_khuyenmainb');
Route::get('/active-khuyenmainb/{khuyenmai_id}','CouponController@active_khuyenmainb');

//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');
Route::post('/delete-feeship','DeliveryController@delete_feeship');

//gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('/select-gallery','GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
Route::post('/update-gallery','GalleryController@update_gallery');

//video
Route::get('/manage-video','VideoController@manage_video');
Route::get('/unactive-video/{video_slug}','VideoController@unactive_video');
Route::get('/active-video/{video_slug}','VideoController@active_video');
Route::get('/delete-video/{video_id}','VideoController@delete_video');
Route::post('/insert-video','VideoController@insert_video');
Route::post('/update-video/{video_id}','VideoController@update_video');

//category document
Route::get('manage-document','DocumentController@manage_document');
Route::get('/delete-category-document/{category_id}','DocumentController@delete_category_document');
Route::get('/unactive-category-document/{category_id}','DocumentController@unactive_category_document');
Route::get('/active-category-document/{category_id}','DocumentController@active_category_document');

Route::post('/insert-category-document','DocumentController@save_category_document')->name('save-category-document');
Route::post('/update-category-document/{category_id}','DocumentController@update_category_document')->name('updateCategoryDocument');

//document
Route::get('/delete-document/{document_id}','DocumentController@delete_document');
Route::get('/unactive-document/{document_id}','DocumentController@unactive_document');
Route::get('/active-document/{document_id}','DocumentController@active_document');

Route::post('/insert-document','DocumentController@save_document');
Route::post('/update-document/{document_id}','DocumentController@update_document')->name('updateDocument');

//profit
Route::get('/profit','ProfitController@profit');
Route::get('/delete-profit/{profit_id}','ProfitController@delete_profit');
Route::post('/insert-profit','ProfitController@insert_profit');
Route::post('/update-profit/{profit_id}','ProfitController@update_profit');

//front-end
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/cong-tac-vien','HomeController@cong_tac_vien');
Route::post('/email','HomeController@email');

Route::post('/add-contact','ContactController@add_contact');

Route::post('/add-customer','HomeController@add_customer');
Route::post('/login-customer','HomeController@login_customer');
Route::get('/dang-ky-hoac-dang-nhap','HomeController@login_register');
Route::post('/tim-kiem','HomeController@search');
Route::post('/tim-kiem-404','HomeController@search404');
Route::get('/lien-he','ContactController@contact');
Route::get('/add-contact','ContactController@add_contact');

Route::get('/logout','HomeController@logout');

Route::get('/chi-tiet-san-pham/{product_slug}','ProductController@details_product');
Route::get('/danh-muc-san-pham/{slug_category_product}','CategoryProductController@show_category_frontend');
Route::get('/thuong-hieu-san-pham/{brand_slug}','BrandProductController@show_brand_frontend');

Route::get('/tin-tuc','BlogController@blog');
Route::get('/danh-muc-tin-tuc/{slug_category_post}','BlogController@blog_category');
Route::get('/chi-tiet-bai-viet/{slug_post}','BlogController@blog_detail');
Route::post('/tim-kiem-bai-viet','BlogController@search_blog');

Route::get('/gio-hang','CartController@show_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-pro/{session_id}','CartController@delete_product');

Route::get('/del-all-product','CartController@delete_all_product');

Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');

Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');

Route::get('/dangnhap-dangky-thanhtoan','CheckoutController@loginregister_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');

Route::get('/dangnhap-dangky-taikhoan','HomeController@login_register');
Route::post('dang-nhap','HomeController@login_customer');
Route::post('dang-ky','HomeController@add_customer');

Route::get('/dang-xuat','CheckoutController@logout');

Route::get('/thanh-toan','CheckoutController@checkout');

Route::post('/export-csv','ProductController@export_csv');
Route::post('/import-csv','ProductController@import_csv');


Route::get('/send-mail','MailController@send_mail');

Route::get('/404','HomeController@error_page');
Route::get('/cam-on','HomeController@camon');

//quatang
Route::post('/qua-tang','OrderController@qua_tang');
Route::get('/qua-tang-tri-an','OrderController@qua_tang_tri_an');

Route::post('/insert-quatang','OrderController@add_quatang');
Route::get('/delete-quatang/{quatang_id}','OrderController@delete_quatang');
Route::post('/update-quatang/{quatang_id}','OrderController@update_quatang'); 
Route::post('/update-totalship/{order_id}','OrderController@update_totalship');