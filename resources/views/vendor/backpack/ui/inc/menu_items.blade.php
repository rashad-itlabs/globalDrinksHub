{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-item title="Add new product" icon="la la-plus" :link="backpack_url('create_product')" />
<x-backpack::menu-dropdown title="Products" icon="la la-box">
    @if(backpack_user()->id==1)
    <x-backpack::menu-dropdown-item title="Categories" icon="la la-code-branch" :link="backpack_url('categories')" />
    <x-backpack::menu-dropdown-item title="Brands" icon="la la-tag" :link="backpack_url('brands')" />
    <x-backpack::menu-dropdown-item title="Attributes" icon="la la-tags" :link="backpack_url('attributes')" />
    <!-- <x-backpack::menu-dropdown-item title="Tax rules" icon="la la-question" :link="backpack_url('taxrules')" /> -->
    <!-- <x-backpack::menu-dropdown-item title="Shipping rules" icon="la la-question" :link="backpack_url('shippingrules')" /> -->
    <x-backpack::menu-dropdown-item title="Collections" icon="la la-list-ul" :link="backpack_url('collections')" />
    <x-backpack::menu-dropdown-item title="Multi Edit Products" icon="la la-box" :link="backpack_url('multieditproducts')" />
    <!-- <x-backpack::menu-dropdown-item title="Bundle deals" icon="la la-question" :link="backpack_url('bundledeals')" />
    <x-backpack::menu-dropdown-item title="Vouchers" icon="la la-question" :link="backpack_url('vouchers')" /> -->
    @endif
<x-backpack::menu-dropdown-item title="Products" icon="la la-box" :link="backpack_url('products')" />
</x-backpack::menu-dropdown>
<!-- <x-backpack::menu-item title="Flash sales" icon="la la-question" :link="backpack_url('flashsales')" /> -->
@if(backpack_user()->id !=1)
<x-backpack::menu-item title="My Sales" icon="la la-clipboard-list" :link="backpack_url('my-sales')" />
@endif
@if(backpack_user()->id !=1)
<x-backpack::menu-item title="My Orders" icon="la la-clipboard-list" :link="backpack_url('orders')" />
@else
<x-backpack::menu-item title="All Orders" icon="la la-clipboard-list" :link="backpack_url('orders')" />
@endif
<x-backpack::menu-item title="Canceled orders" icon="la la-window-close" :link="backpack_url('canceled-order')" />
<!-- <x-backpack::menu-item title="Rating reviews" icon="la la-question" :link="backpack_url('raiting')" /> -->
@if(backpack_user()->id==1)
<x-backpack::menu-item title="Abouts" icon="la la-tag" :link="backpack_url('about')" />
<x-backpack::menu-item title="Faqs" icon="la la-question-circle" :link="backpack_url('faq')" />
<!-- <x-backpack::menu-dropdown title="Users" icon="la la-users">
    <x-backpack::menu-dropdown-item title="Registrated" icon="la la-question" :link="backpack_url('users')" />
    <x-backpack::menu-dropdown-item title="Guests" icon="la la-question" :link="backpack_url('guest')" />
</x-backpack::menu-dropdown> -->
@endif
@if(backpack_user()->id==1)
<x-backpack::menu-dropdown title="Subscriptions" icon="la la-mail-forward">
    <x-backpack::menu-dropdown-item title="Subscribers" icon="la la-mail-forward" :link="backpack_url('subscription-emails')" />
    <x-backpack::menu-dropdown-item title="Email formats" icon="la la-mail-bulk" :link="backpack_url('subscription-email-formats')" />
</x-backpack::menu-dropdown>
@endif
<x-backpack::menu-item title="Bulk upload" icon="la la-file-excel" :link="backpack_url('bulk')" />
@if(backpack_user()->id==1)
<!-- <x-backpack::menu-item title="Roles & permissions" icon="la la-question" :link="backpack_url('roles')" /> -->
<x-backpack::menu-item title="Admins & vendors" icon="la la-users-cog" :link="backpack_url('admins')" />
@endif
<!-- <x-backpack::menu-dropdown title="Withdrawals" icon="la la-question">
    <x-backpack::menu-dropdown-item title="Requests" icon="la la-question" :link="backpack_url('withdrawal-requests')" />
    <x-backpack::menu-dropdown-item title="Accounts" icon="la la-question" :link="backpack_url('withdrawal-account')" />
</x-backpack::menu-dropdown> -->
@if(backpack_user()->id==1)
<x-backpack::menu-dropdown title="UI" icon="la la-adjust">
    <!-- <x-backpack::menu-dropdown-item title="Pages" icon="la la-file-o" :link="backpack_url('pages')" /> -->
    <x-backpack::menu-dropdown-item title="Home sliders" icon="la la-sliders-h" :link="backpack_url('homesliders')" />
    <x-backpack::menu-dropdown-item title="Banners" icon="la la-image" :link="backpack_url('banners')" />
    <!-- <x-backpack::menu-dropdown-item title="Footer links" icon="la la-question" :link="backpack_url('footerlinks')" /> -->
    <x-backpack::menu-dropdown-item title="Header links" icon="la la-link" :link="backpack_url('headerlinks')" />
    <!-- <x-backpack::menu-dropdown-item title="Site featues" icon="la la-question" :link="backpack_url('sitefeatues')" /> -->
    <x-backpack::menu-dropdown-item title="Site setting" icon="la la-cog" :link="backpack_url('sitesettings')" />
    <x-backpack::menu-dropdown-item title="Contact settings" icon="la la-phone-volume" :link="backpack_url('contact-us')" />
    <!-- <x-backpack::menu-dropdown-item title="Custom scripts" icon="la la-question" :link="backpack_url('customscripts')" /> -->
</x-backpack::menu-dropdown>
@endif
@if(backpack_user()->id==1)
<x-backpack::menu-item title="Stores" icon="la la-store" :link="backpack_url('store')" />
<x-backpack::menu-item title="Settings" icon="la la-cog" :link="backpack_url('setting')" />
@endif