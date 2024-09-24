<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\BulkController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CustomsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HeaderlinksController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\Frontend\VendorController;
use App\Http\Controllers\VouchersController;
use App\Http\Controllers\AboutUsController;
use App\Models\Brands;
use App\Models\Homeslider;
use Illuminate\Support\Facades\Route;

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

//  Route::get('panel/login',[AuthController::class,'login'])->name('panel/login');
//  Route::post('panel/login_auth',[AuthController::class,'auth'])->name('panel/login_auth');
//Route::get('panel',[AdminsController::class,'admin_login'])->name('panel');


Route::group([
    'prefix' => config('backpack.base.route_prefix', 'panel'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'panel')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () {

    Route::get('categories',[CategoriesController::class,'index'])->name('categories');
    Route::get('attributes',[AttributesController::class,'index'])->name('attributes');
    Route::get('attributes/{id}/edit',[AttributesController::class,'edit_page'])->name('attributes');
  //  Route::get('collections',[CollectionController::class,'index'])->name('collections');
    Route::get('vouchers',[VouchersController::class,'index'])->name('vouchers');
    Route::get('products',[ProductsController::class,'list'])->name('products');
    Route::get('homesliders',[HomeSliderController::class,'index'])->name('homesliders');
    Route::get('banners',[BannerController::class,'index'])->name('banners');
    Route::get('footerlinks',[FooterLinkController::class,'list'])->name('footerlinks');
    Route::get('headerlinks',[HeaderlinksController::class,'headerlist'])->name('headerlinks');
    Route::get('sitefeatues',[FeaturesController::class,'index'])->name('sitefeatues');
    Route::get('sitesettings',[SettingsController::class,'index'])->name('sitesettings');
    Route::get('customscripts',[CustomsController::class,'index'])->name('customscripts');
    Route::get('store',[StoreController::class,'store'])->name('store');
    Route::get('setting',[SettingsController::class,'settings'])->name('setting');
    Route::get('edit/{id}/language',[SettingsController::class,'edit_langs']);
    Route::get('store_attribute',[AttributesController::class,'store'])->name('store_attribute');
    Route::post('create_value',[AttributesController::class,'create'])->name('create_value');
    Route::post('update_value',[AttributesController::class,'update'])->name('update_value');
    Route::get('delete_attribute/{id}',[AttributesController::class,'attribute_delete'])->name('delete_attribute');

    Route::post('create_admins',[AdminsController::class,'create'])->name('create_admins');
    Route::post('edit_admin',[AdminsController::class,'update_admin'])->name('edit_admin');
    Route::post('update_store',[StoreController::class,'update'])->name('update_store');

    Route::get('add_new_categories',[CategoriesController::class,'add_new'])->name('add_new_categories');
    Route::post('createCategories',[CategoriesController::class,'store'])->name('createCategories');

    Route::get('category_edit/{id}/edit',[CategoriesController::class,'edit'])->name('category_edit');
    Route::post('update_categories',[CategoriesController::class,'updateCategories'])->name('update_categories');
    Route::get('list/{id}/delete',[CategoriesController::class,'delete'])->name('list');

    // IMAGES
    Route::get('images',[ImagesController::class,'index'])->name('images');
    Route::post('remove_images',[ImagesController::class,'remove'])->name('remove_images');

    //Product
    Route::get('create_product', [ProductsController::class, 'store'])->name('create_product');
    Route::get('edit_product/{id}', [ProductsController::class, 'edit'])->name('edit_product');
    Route::get('delete_product/{id}', [ProductsController::class, 'remove_products'])->name('delete_product');
    Route::get('load_primary_categories',[ProductsController::class,'load_primary_categories'])->name('load_primary_categories');
    Route::post('create_products',[ProductsController::class,'create_product'])->name('create_products');
    Route::post('update',[ProductsController::class,'update_product'])->name('update');
    Route::post('update_multi',[ProductsController::class,'update_multi'])->name('update_multi');
    Route::post('action_products',[ProductsController::class,'action_products'])->name('action_products');
    Route::get('product/{id}/delete',[ProductsController::class,'remove'])->name('product');
    Route::get('multieditproducts',[ProductsController::class,'multi_edit'])->name('multieditproducts');
    Route::get('moderation_products',[ProductsController::class,'moderation'])->name('moderation_products');
    Route::get('jsonProdName',[ProductsController::class,'jsonProdName'])->name('jsonProdName');
    Route::get('jsonProdImage',[ProductsController::class,'jsonProdImage'])->name('jsonProdImage');
    Route::get('jsonProdNameEdit',[ProductsController::class,'jsonProdNameEdit'])->name('jsonProdNameEdit');

    // Profile
    Route::get('profile',[AdminsController::class,'profile_settings'])->name('profile');
    

    // Bulk
    Route::get('bulk',[BulkController::class,'index'])->name('bulk');
    Route::get('export_xlsx',[BulkController::class,'exporting'])->name('export_xlsx');
    Route::post('import_xlsx',[BulkController::class,'importing'])->name('import_xlsx');
    Route::get('exportUsers_xlsx',[AdminsController::class,'export_user'])->name('exportUsers_xlsx');
    Route::get('exportProduct_xlsx',[ProductsController::class,'export_product'])->name('exportProduct_xlsx');
    

    //Brend
    Route::post('addBrend',[BrandsController::class,'create'])->name('addBrend');
    Route::get('brands/{id}/edit',[BrandsController::class,'edit'])->name('brands');
    Route::post('update_brands',[BrandsController::class,'update'])->name('update_brands');
    Route::post('autouploadImage',[BrandsController::class,'autouploadImage'])->name('autouploadImage');
    Route::post('addOnly',[BrandsController::class,'addOnly'])->name('addOnly');
    Route::get('remove',[BrandsController::class,'remove_prod_name'])->name('remove');
    

    //Settins
    Route::post('change_currency',[SettingsController::class,'update_currency'])->name('change_currency');
    Route::post('change_address',[SettingsController::class,'update_address'])->name('change_address');
    Route::post('change_language',[SettingsController::class,'update_language'])->name('change_language');
    Route::get('delete_lang/{id}',[SettingsController::class,'delete_language'])->name('delete_lang');
    Route::post('update-smtp',[SettingsController::class,'updatesmtp'])->name('update-smtp');

    // Pages
    Route::post('create_pages',[PagesController::class,'store'])->name('create_pages');
    Route::post('update_pages',[PagesController::class,'update'])->name('update_pages');

    // Header links
    Route::get('header/{id}/delete',[HeaderlinksController::class,'delete'])->name('header');
    Route::post('update_headerlink',[HeaderlinksController::class,'update'])->name('update_headerlink');

    // Banner
    Route::get('banner/{id}/edit',[BannerController::class,'edit'])->name('banner');

    // Sitesettings
    Route::post('update_site_settings',[SiteSettingsController::class,'update'])->name('update_site_settings');

    // Homeslider
    Route::get('create_slider',[SliderController::class,'create'])->name('create_slider');
    Route::post('add_slider',[HomeSliderController::class,'add'])->name('add_slider');
    Route::get('edit/{id}/slider',[HomeSliderController::class,'editPage'])->name('edit');

    // Reject message
    Route::post('reject_product',[ProductsController::class,'reject_product'])->name('reject_product');

    // Contacts
    Route::post('save_info',[SettingsController::class,'save_update'])->name('save_info');




});
Route::get('success_page',[LoginController::class, 'successPage'])->name('success_page');
Route::post('create_register',[LoginController::class,'create'])->name('create_register');
Route::post('login',[LoginController::class,'signin'])->name('login');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/',[IndexController::class,'index'])->name('/');
Route::get('product_detail/{id}/product',[IndexController::class,'product_page'])->name('product_detail');
Route::get('login',[IndexController::class,'login_page'])->name('login');
Route::get('register',[IndexController::class,'register_page'])->name('register');
Route::get('categories/{id}/category',[IndexController::class,'categories'])->name('categories');
Route::get('page/about',[IndexController::class,'about'])->name('/page/about');
Route::get('brands',[IndexController::class,'brands'])->name('/brands');
Route::get('brand/{id}/brand',[IndexController::class,'brandlist'])->name('brand');
Route::get('category/{id}/category',[IndexController::class,'categories'])->name('category');
Route::get('all/products',[IndexController::class,'products'])->name('/all/products');
Route::get('flash-sale',[IndexController::class,'flash_sale'])->name('/flash-sale');
Route::get('track-order',[IndexController::class,'track_order'])->name('/track-order');
Route::get('page/faq',[IndexController::class,'faq'])->name('/page/faq');
Route::get('page/help',[IndexController::class,'help'])->name('/page/help');
Route::get('page/contact',[IndexController::class,'contact'])->name('/page/contact');
Route::get('buy',[IndexController::class,'buy'])->name('buy');
Route::get('sell',[IndexController::class,'sell_route'])->name('sell');

Route::get('addtocard',[CardController::class,'card'])->name('addtocard');
Route::get('card',[CardController::class,'index'])->name('card');
Route::get('remove_card/{id}',[CardController::class,'remove'])->name('remove_card');
Route::get('loadBrand/{id}/brand',[IndexController::class,'loadBrand'])->name('loadBrand');

Route::post('ajaxFilter',[IndexController::class,'ajax_brand_filter'])->name('ajaxFilter');

// subscription
Route::post('add_subscription',[IndexController::class,'addSubs'])->name('add_subscription');

// Forget pass
Route::get('forget_password',[IndexController::class,'f_pass'])->name('forget_password');
Route::post('check_mail',[LoginController::class,'checkMail'])->name('check_mail');
Route::get('reset_password',[LoginController::class,'resetPassword'])->name('reset_password');
Route::post('resetPassword',[LoginController::class,'resetPass'])->name('resetPassword');
Route::get('verifying_account',[AdminsController::class,'verifying'])->name('verifying_account');

// SearchFilter
Route::get('showSearchFilter',[IndexController::class,'searchResult'])->name('showSearchFilter');

//About
Route::post('updateOperation',[AboutUsController::class,'edit'])->name('updateOperation');

// Orders
Route::post('check_order',[CardController::class,'check'])->name('check_order');
Route::post('change_order_status',[CardController::class,'changeOrder'])->name('change_order_status');

// USER
Route::get('auth_vendor_panel',[VendorController::class,'index'])->name('auth_vendor_panel');