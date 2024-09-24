<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

// Auth::routes([
//     'verify'=>true
// ]);

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('products', 'ProductsCrudController');
    Route::crud('flashsales', 'FlashsalesCrudController');
    Route::crud('orders', 'OrdersCrudController');
    Route::crud('raiting', 'RaitingCrudController');
    Route::crud('users', 'UsersCrudController');
    Route::crud('subscription', 'SubscriptionCrudController');
    Route::crud('bulk', 'BulkCrudController');
    Route::crud('roles', 'RolesCrudController');
    Route::crud('admins', 'AdminsCrudController');
    Route::crud('withdrawal', 'WithdrawalCrudController');
    Route::crud('u-i', 'UICrudController');
    Route::crud('store', 'StoreCrudController');
    Route::crud('setting', 'SettingCrudController');
    Route::crud('categories', 'CategoriesCrudController');
    Route::crud('brands', 'BrandsCrudController');
    Route::crud('attributes', 'AttributesCrudController');
    Route::crud('taxrules', 'TaxrulesCrudController');
    Route::crud('shippingrules', 'ShippingrulesCrudController');
    Route::crud('collections', 'CollectionsCrudController');
    Route::crud('bundledeals', 'BundledealsCrudController');
    Route::crud('vouchers', 'VouchersCrudController');
    Route::crud('registrated', 'RegistratedCrudController');
    Route::crud('guest', 'GuestCrudController');
    Route::crud('subscribers', 'SubscribersCrudController');
    Route::crud('emailformats', 'EmailformatsCrudController');
    Route::crud('pages', 'PagesCrudController');
    Route::crud('homesliders', 'HomeslidersCrudController');
    Route::crud('banners', 'BannersCrudController');
    Route::crud('footerlinks', 'FooterlinksCrudController');
    Route::crud('headerlinks', 'HeaderlinksCrudController');
    Route::crud('sitefeatues', 'SitefeatuesCrudController');
    Route::crud('sitesettings', 'SitesettingsCrudController');
    Route::crud('customscripts', 'CustomscriptsCrudController');
    Route::crud('requests', 'RequestsCrudController');
    Route::crud('accounts', 'AccountsCrudController');
    Route::crud('withdrawal-account', 'WithdrawalAccountCrudController');
    Route::crud('withdrawal-requests', 'WithdrawalRequestsCrudController');
    Route::crud('subscription-emails', 'SubscriptionEmailsCrudController');
    Route::crud('subscription-email-formats', 'SubscriptionEmailFormatsCrudController');
    Route::crud('about', 'AboutCrudController');
    Route::crud('faq', 'FaqCrudController');
    Route::crud('canceled-order', 'CanceledOrderCrudController');
    Route::crud('contact-us', 'ContactUsCrudController');
    Route::crud('add-new-product', 'AddNewProductCrudController');
    Route::crud('my-sales', 'MySalesCrudController');
}); // this should be the absolute last line of this file