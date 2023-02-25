<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\Setting\SeoController;
use App\Http\Controllers\Backend\Setting\WebsiteController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserOrderController;

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

//front
Route::controller(IndexController::class)->group(function(){
    //front page
    Route::get('/','welcome')->name('welcome');
    //product details
    Route::get('/product/{sku}/{id}/{slug}','productDetails')->name('product.details');
    //all subcategory products
    Route::get('/subcategory/{id}','productSubcategoryDetails')->name('product.subcategory.details');
    //all subsub catgeory products
    Route::get('/subsubcategory/{id}','productSubsubcategoryDetails')->name('product.subsubcategory.details');
    //all brand products
    Route::get('/brand/{id}','productBrandDetails')->name('product.brand.details');
    //product view modal
    Route::get('/products/view/modal/{id}', 'productViewAjax');

    //about us
    Route::get('/about-us','aboutUs')->name('about.us');
    //contact us
    Route::get('/contact-us','contactUs')->name('contact.us');
    Route::post('/contact-store','contactStore')->name('contact.store');

    //product search
    Route::post('/product-search','productSearch')->name('product.search');

    //blog
    Route::get('/blog/index','blogIndex')->name('blog.index');
    Route::get('/blog/categories/{slug}/{id}/index','blogCategoryIndex')->name('blog.category.index');
    Route::get('/blog/{slug}/{id}/show','showBlog')->name('blog.show');
    
    //blog search
    Route::post('/blog/post-search','blogSearch');
    Route::post('/blog/post-search/index','blogSearchIndex')->name('blog.search');

    Route::get('/test', 'test');
});

//cart controller
Route::controller(CartController::class)->group(function(){
    //add to cart
    Route::post('/cart/product/store/{id}', 'addToCart');
    //minicart
    Route::get('/product/mini/cart', 'productMiniCart');
    //mini cart remove item
    Route::get('/mini/cart/product/remove/{rowId}', 'removeMiniCartItem');
    //add to wishlist
    Route::post('/add-to-wishlist/{id}', 'addToWishlist');
});

//user cart controller
Route::controller(UserCartController::class)->group(function(){
    //wishlist
    Route::get('/mycart', 'myCart')->name('mycart');
    //get cart product
    Route::get('/get-cart-product', 'getCartProduct');
    //remove cart item
    Route::get('/cart/remove/item/{rowId}', 'removeCartItem');
    //quantity increment
    Route::get('/cart/qty/increment/{rowId}', 'qtyIncrement');
    //quantity decrement
    Route::get('/cart/qty/decrement/{rowId}', 'qtyDecrement');

    //coupon apply
    Route::post('/coupon-apply','couponApply');
    //coupon-calculation
    Route::get('/coupon-calculation','couponCalculation');
    //coupon-remove
    Route::get('/coupon-remove','CouponRemove');

    //checkout
    Route::get('/checkout', 'checkoutCreate')->name('checkout');
    //coupon-calculation-checkout
    Route::get('/coupon-calculation-checkout','couponCalculationCheckout');
});


// all user routes
Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified', 'user'
])->group(function () {
    Route::get('/dashboard',[App\Http\Controllers\UserController::class, 'userDashboard'])->name('dashboard');
    Route::prefix('dashboard/user')->group(function(){

        //user controller
        Route::controller(UserController::class)->group(function(){
            //user profile
            Route::get('/profile/edit/{id}/{name}','UserProfileEdit')->name('user.profile.edit');
            Route::patch('/profile/update/{id}','UserProfileUpdate')->name('user.profile.update');
            Route::get('/password/view/{id}/{name}', 'UserPasswordView')->name('user.password.view');
            Route::patch('/password/change', 'UserPasswordChange')->name('user.password.change');
        });
    });

    //wishlist controller
    Route::middleware(['user'])->controller(WishlistController::class)->group(function(){
        //wishlist
        Route::get('/wishlist', 'wishlist')->name('wishlist');
        //get wishlist product
        Route::get('/get-wishlist-product', 'getWishlistProduct');
        //remove wishlist item
        Route::get('/wishlist/product/remove/{id}', 'removeWishlistItem');
    });

    //checkout
    Route::middleware(['user'])->controller(CheckoutController::class)->group(function(){
        Route::get('/checkout/district/ajax/{state_id}','getDistrict');
        Route::get('/checkout/pincode/ajax/{district_id}','getPincode');
        Route::post('/checkout/store','checkoutStore')->name('checkout.store');
    });

    //stripe
    Route::middleware(['user'])->controller(StripeController::class)->group(function(){
        Route::post('/checkout/stripe/order','stripeOrder')->name('stripe.order');
    });

    //user order
    Route::controller(UserOrderController::class)->group(function(){
        Route::get('user/myorders','myOrders')->name('myorder');
        Route::get('user/orders/view/{order_id}/{order_number}','orderDetails')->name('order.view');
    });

    //cash
    Route::middleware(['user'])->controller(CashController::class)->group(function(){
        Route::post('/checkout/cash/order','cashOrder')->name('cash.order');
    });

    //user order
    Route::controller(UserOrderController::class)->group(function(){
        Route::get('user/invoice/download/view/{order_id}/{order_number}','invoiceDownload')->name('invoice.download');
        Route::post('user/return/order/reason/{order_id}','returnOrderReason')->name('order.return.reason');
        Route::get('user/myorders/return/list','returnOrderList')->name('return.order.list');
        Route::get('user/myorders/cancel/list','cancelOrderList')->name('cancel.order.list');
        Route::get('user/order/cancel/{id}/','cancelOrder')->name('cancel.order');
    });

});




//admin controller
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});

//admin dashboard
Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified', 'has.permission'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin_dashboard')->middleware('auth:admin');
    //admin routes
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::prefix('admin/dashboard')->group(function(){
        //admin
        Route::controller(AdminProfileController::class)->group(function(){
            //admin prodile
            Route::get('/profile','AdminProfile')->name('admin.profile.view');
            Route::get('/profile/edit','AdminEditProfile')->name('admin.profile.edit');
            Route::patch('/profile/store','AdminStoreProfile')->name('admin.profile.store');
            Route::get('/profile/change/password','AdminPasswordProfile')->name('admin.profile.password');
            Route::patch('/profile/update/password','AdminUpdatePassword')->name('admin.password.update');

            //all admin
            Route::get('/admins','AdminIndex')->name('admins.index');
            Route::get('/create','AdminCreate')->name('admins.create');
            Route::post('/store','AdminStore')->name('admins.store');
            Route::get('/edit/{id}','AdminEdit')->name('admins.edit');
            Route::patch('/update/{id}','AdminUpdate')->name('admins.update');
            Route::delete('/delete/{id}','AdminDelete')->name('admins.delete');

            //all user
            Route::get('/users','UserIndex')->name('users.index');
        });

        //permission
        Route::resource('permissions','App\Http\Controllers\Backend\PermissionController');

        //role
        Route::resource('roles','App\Http\Controllers\Backend\RoleController');

        //brand
        Route::controller(App\Http\Controllers\Backend\BrandController::class)->group(function(){
            Route::get('/brands/create','create')->name('brands.create');
            Route::post('/brands/store','store')->name('brands.store');
            Route::get('/brands','index')->name('brands.index');
            Route::get('/brands/destroy/{slug}','destroy')->name('brands.destroy');
            Route::get('/brands/{slug}/edit', 'edit')->name('brands.edit');
            Route::patch('/brands/{id}/update', 'update')->name('brands.update');
        });

        //category
        Route::controller(App\Http\Controllers\Backend\CategoryController::class)->group(function(){
            Route::get('/categories/create','create')->name('categorys.create');
            Route::post('/categories/store','store')->name('categorys.store');
            Route::get('/categories','index')->name('categorys.index');
            Route::get('/categories/destroy/{id}','destroy')->name('categorys.destroy');
            Route::get('/categories/{slug}/{id}/edit', 'edit')->name('categorys.edit');
            Route::patch('/categories/{id}/update', 'update')->name('categorys.update');
        });

        //subcategory
        Route::controller(App\Http\Controllers\Backend\SubCategoryController::class)->group(function(){
            Route::get('/sub/categories/create','create')->name('subcategorys.create');
            Route::post('/sub/categories/store','store')->name('subcategorys.store');
            Route::get('/sub/categories','index')->name('subcategorys.index');
            Route::get('/sub/categories/destroy/{id}','destroy')->name('subcategorys.destroy');
            // Route::get('/sub/categories/{slug}/edit', 'edit')->name('subcategorys.edit');
            // Route::patch('/sub/categories/{id}/update', 'update')->name('subcategorys.update');
        });

        //sub->subcategories
        Route::controller(App\Http\Controllers\Backend\SubCategoryController::class)->group(function(){
            Route::get('/sub/sub/categories/create','subcreate')->name('subsubcategorys.create');
            Route::post('/sub/sub/categories/store','substore')->name('subsubcategorys.store');
            Route::get('/sub/sub/categories','subindex')->name('subsubcategorys.index');
            Route::get('/sub/sub/categories/destroy/{id}','subdestroy')->name('subsubcategorys.destroy');
            // Route::get('/sub/sub/categories/{slug}/edit', 'subedit')->name('subsubcategorys.edit');
            // Route::patch('/sub/sub/categories/{id}/update', 'subupdate')->name('subsubcategorys.update');
            Route::get('/category/subcategory/ajax/{category_id}','getSubCategory');
            Route::get('/category/subcategory/sub-subcategory/ajax/{subcategory_id}','getSubSubCategory');
        });

        //products
        Route::controller(App\Http\Controllers\Backend\ProductController::class)->group(function(){
            Route::get('/products/create','create')->name('products.create');
            Route::post('/products/store','store')->name('products.store');
            Route::get('/products','index')->name('products.index');
            Route::get('/products/destroy/{id}','destroy')->name('products.destroy');
            Route::get('/products/image/destroy/{id}','destroyImage')->name('products.image.destroy');
            Route::get('/products/{id}/edit', 'edit')->name('products.edit');
            Route::patch('/products/{id}/update', 'update')->name('products.update');
            Route::post('/products/image/update', 'updateImage')->name('products.image.update');
            Route::get('/products/inactive/{id}', 'productInactive')->name('products.inactive');
            Route::get('/products/active/{id}', 'productActive')->name('products.active');

            //pending
            Route::get('/pending','PendingIndex')->name('pending.index');
            Route::get('accept-reject-product/{id}','acceptReject')->name('accept.reject');
        });

        //sliders
        Route::controller(App\Http\Controllers\Backend\SliderController::class)->group(function(){
            Route::get('/sliders/create','create')->name('sliders.create');
            Route::post('/sliders/store','store')->name('sliders.store');
            Route::get('/sliders','index')->name('sliders.index');
            Route::get('/sliders/destroy/{id}','destroy')->name('sliders.destroy');
            Route::get('/sliders/{id}/edit', 'edit')->name('sliders.edit');
            Route::patch('/sliders/{id}/update', 'update')->name('sliders.update');
            Route::get('/sliders/inactive/{id}', 'sliderInactive')->name('sliders.inactive');
            Route::get('/sliders/active/{id}', 'sliderActive')->name('sliders.active');
        });

        //banners
        Route::controller(App\Http\Controllers\Backend\BannerController::class)->group(function(){
            Route::post('/banners/store','store')->name('banners.store');
            Route::get('/banners','index')->name('banners.index');
            Route::get('/banners/destroy/{id}','destroy')->name('banners.destroy');
            Route::get('/banners/{id}/edit', 'edit')->name('banners.edit');
            Route::patch('/banners/{id}/update', 'update')->name('banners.update');
            Route::get('/banners/inactive/{id}', 'bannerInactive')->name('banners.inactive');
            Route::get('/banners/active/{id}', 'bannerActive')->name('banners.active');
        });

        //coupons
        Route::controller(App\Http\Controllers\Backend\CouponController::class)->group(function(){
            Route::post('/coupons/store','store')->name('coupons.store');
            Route::get('/coupons','index')->name('coupons.index');
            Route::get('/coupons/destroy/{id}','destroy')->name('coupons.destroy');
            Route::get('/coupons/{id}/edit', 'edit')->name('coupons.edit');
            Route::patch('/coupons/{id}/update', 'update')->name('coupons.update');
            Route::get('/coupons/inactive/{id}', 'couponInactive')->name('coupons.inactive');
            Route::get('/coupons/active/{id}', 'couponActive')->name('coupons.active');
        });

        //states
        Route::controller(App\Http\Controllers\Shipping\StateController::class)->group(function(){
            Route::post('/states/store','store')->name('states.store');
            Route::get('/states','index')->name('states.index');
            Route::get('/states/destroy/{id}','destroy')->name('states.destroy');
            Route::get('/states/{id}/edit', 'edit')->name('states.edit');
            Route::patch('/states/{id}/update', 'update')->name('states.update');
        });

        //districts
        Route::controller(App\Http\Controllers\Shipping\DistrictController::class)->group(function(){
            Route::post('/districts/store','store')->name('districts.store');
            Route::get('/districts','index')->name('districts.index');
            Route::get('/districts/destroy/{id}','destroy')->name('districts.destroy');
            Route::get('/districts/{id}/edit', 'edit')->name('districts.edit');
            Route::patch('/districts/{id}/update', 'update')->name('districts.update');
        });

        //postal codes
        Route::controller(App\Http\Controllers\Shipping\PostalCodeController::class)->group(function(){
            Route::post('/postal-codes/store','store')->name('postalcodes.store');
            Route::get('/postal-codes','index')->name('postalcodes.index');
            Route::get('/postal-codes/destroy/{id}','destroy')->name('postalcodes.destroy');
            Route::get('/postal-codes/{id}/edit', 'edit')->name('postalcodes.edit');
            Route::patch('/postal-codes/{id}/update', 'update')->name('postalcodes.update');
            Route::get('/state/district/ajax/{state_id}','getDistrict');
        });

        //orders
        Route::controller(App\Http\Controllers\Backend\OrderController::class)->group(function(){
            Route::get('/orders/all-orders-list','allOrders')->name('all.orders');
            Route::get('/orders/pending-list','pendingOrders')->name('orders.pending');
            Route::get('/orders/order-list/{id}/details','orderDetails')->name('order.details');
            Route::get('/orders/confirmed-list','confirmedOrders')->name('orders.confirmed');
            Route::get('/orders/processing-list','processingOrders')->name('orders.processing');
            Route::get('/orders/picked-list','pickedOrders')->name('orders.picked');
            Route::get('/orders/shipped-list','shippedOrders')->name('orders.shipped');
            Route::get('/orders/delivered-list','deliveredOrders')->name('orders.delivered');
            Route::get('/orders/cancel-list','cancelOrders')->name('orders.cancel');

            //update status to confirm
            Route::get('/orders/pending/{id}/confirm/','pendingConfirm')->name('pending.confirm');
            Route::get('/orders/confirm/{id}/processing/','confirmProcessing')->name('confirm.processing');
            Route::get('/orders/processing/{id}/picked/','processingPicked')->name('processing.picked');
            Route::post('/orders/picked/{id}/shipped/','pickedShipped')->name('picked.shipped');
            Route::get('/orders/shipped/{id}/delivered/','shippedDelivered')->name('shipped.delivered');

            //invoice download
            Route::get('/orders/invoice/{id}/download/','orderInvoiceDownload')->name('order.invoice.download');
        });

        //report
        Route::controller(App\Http\Controllers\Backend\ReportController::class)->prefix('reports')->group(function(){
            Route::get('/orders/view','ordersReportView')->name('orders.report');
            Route::post('/search/by/date/view','reportByDate')->name('report.by.date');
            Route::post('/search/by/month/view','reportByMonth')->name('report.by.month');
            Route::post('/search/by/year/view','reportByYear')->name('report.by.year');
        });

        //seo setting
        Route::controller(SeoController::class)->prefix('setting')->group(function(){
            Route::get('/seo/view','seoSetting')->name('seo.view');
            Route::post('/seo/update/view','seoSettingUpdate')->name('seo.update');
        });

        //website setting
        Route::controller(WebsiteController::class)->prefix('setting')->group(function(){
            Route::get('/website/view','websiteSetting')->name('website.view');
            Route::post('/website/update/view','websiteSettingUpdate')->name('website.update');
        });

        //blog
        
        //category
        Route::controller(App\Http\Controllers\Backend\blog\CategoryController::class)->prefix('blog')->group(function(){
            Route::get('/categorys-create','create')->name('blog_categorys.index');
            Route::post('/categorys-store','store')->name('blog_categorys.store');
            Route::get('/categorys-destroy/{id}','destroy')->name('blog_categorys.destroy');
        });
        
        //post
        Route::controller(App\Http\Controllers\Backend\blog\PostController::class)->prefix('blog')->group(function(){
            Route::get('/posts/create','create')->name('blog.posts.create');
            Route::post('/posts/store','store')->name('blog.posts.store');
            Route::get('/posts','index')->name('blog.posts.index');
            Route::get('/posts/destroy/{id}','destroy')->name('blog.posts.destroy');
            Route::get('/posts/{id}/{slug}/edit', 'edit')->name('blog.posts.edit');
            Route::post('/posts/{id}/update', 'update')->name('blog.posts.update');
            //pending
            Route::get('/pending','PendingIndex')->name('blog.pending.index');
            Route::get('accept-reject-post/{id}','acceptReject')->name('blog.accept.reject');
        });
    });
});
