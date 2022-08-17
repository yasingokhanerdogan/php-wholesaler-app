@php
    $pending_orders = \App\Models\OrderModel::where("status", "=", "pending")->orWhere("status", "=", "paid")->get();
    $pending_payments = \App\Models\PaymentNoticeModel::where("status", "=", "pending")->get();
@endphp
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url("backend.client.home") }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ $settings->favicon }}" alt="" height="22">
                        </span>
            <span class="logo-lg">
                            <img src="{{ $settings->logo }}" alt="" height="75">
                        </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

            @if($authUser->role == "client")

                    <li>
                        <a href="{{ url("backend.client.home") }}">
                            <i class="uil-home-alt"></i>
                            <span>Kontrol Paneli</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.client.products") }}">
                            <i class="uil-store"></i>
                            <span>Ürünler</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.client.orders") }}">
                            <i class="uil-invoice"></i>
                            <span>Siparişlerim</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-dollar-alt"></i>
                            <span>Ödemelerim</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ url("backend.client.paymentNotice.add") }}">Ödeme Bildirimi Yap</a></li>
                            <li><a href="{{ url("backend.client.paymentNotices") }}">Ödeme Bildirimlerim</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url("backend.client.bankAccounts") }}">
                            <i class="uil-paypal"></i>
                            <span>Banka Hesapları</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.client.faqs") }}">
                            <i class="uil-chart"></i>
                            <span>Sıkça Sorulan Sorular</span>
                        </a>
                    </li>
            @elseif($authUser->role == "admin")

                    <li>
                        <a href="{{ url("backend.admin.home") }}">
                            <i class="uil-home-alt"></i>
                            <span>Kontrol Paneli</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-store-alt"></i>
                            <span>Ürünler</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ url("backend.admin.product.add") }}">Ürün Ekle</a></li>
                            <li><a href="{{ url("backend.admin.products") }}">Ürün Listesi</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.categories") }}">
                            <i class="uil-list-ul"></i>
                            <span>Kategoriler</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.contactInbox") }}">
                            <i class="uil-mailbox"></i>
                            <span>Gelen Kutusu</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-users-alt"></i>
                            <span>Kullanıcılar</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ url("backend.admin.users.add") }}">Kullanıcı Ekle</a></li>
                            <li><a href="{{ url("backend.admin.users.clients") }}">Müşteriler</a></li>
                            <li><a href="{{ url("backend.admin.users.admins") }}">Yöneticiler</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-invoice"></i>
                            <span>Gelen Siparişler</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ url("backend.admin.order.pendingOrders") }}">Bekleyen Siparişler</a></li>
                            <li><a href="{{ url("backend.admin.order.controlledOrders") }}">Kontrol Edilenler</a></li>
                            <li><a href="{{ url("backend.admin.order.processedOrders") }}">İşlenen Siparişler</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.paymentNotices") }}">
                            <i class="uil-dollar-alt"></i>
                            <span>Ödeme Bildirimleri</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.bank.accounts") }}">
                            <i class="uil-paypal"></i>
                            <span>Banka Hesapları</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.faqs") }}">
                            <i class="uil-chart"></i>
                            <span>Sıkça Sorulan Sorular</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.settings") }}">
                            <i class="uil-cog"></i>
                            <span>Ayarlar</span>
                        </a>
                    </li>


            @elseif($authUser->role == "staff")

                    <li>
                        <a href="{{ url("backend.admin.home") }}">
                            <i class="uil-home-alt"></i>
                            <span>Kontrol Paneli</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.categories") }}">
                            <i class="uil-list-ul"></i>
                            <span>Kategoriler</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.contactInbox") }}">
                            <i class="uil-mailbox"></i>
                            <span>Gelen Kutusu</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="@if($authUser->role == "client" || $pending_orders->count() == 0) has-arrow @endif waves-effect">
                            <i class="uil-invoice"></i>
                            @if($authUser->role != "client" && $pending_orders->count() > 0)
                                <span class="badge rounded-pill bg-info float-end">{{ $pending_orders->count() }}</span>
                            @endif
                            <span>Gelen Siparişler</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ url("backend.admin.order.pendingOrders") }}">Bekleyen Siparişler</a></li>
                            <li><a href="{{ url("backend.admin.order.controlledOrders") }}">Kontrol Edilenler</a></li>
                            <li><a href="{{ url("backend.admin.order.processedOrders") }}">İşlenen Siparişler</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.paymentNotices") }}">
                            <i class="uil-dollar-alt"></i>
                            @if($authUser->role != "client" && $pending_payments->count() > 0)
                                <span class="badge rounded-pill bg-info float-end">{{ $pending_payments->count() }}</span>
                            @endif
                            <span>Ödeme Bildirimleri</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url("backend.admin.faqs") }}">
                            <i class="uil-chart"></i>
                            <span>Sıkça Sorulan Sorular</span>
                        </a>
                    </li>

            @endif

<!--
                <li>
                    <a href="#">
                        <i class="uil-home-alt"></i>
                        <span>Kontrol Paneli</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="#">Vertical</a></li>
                        <li><a href="#">Vertical</a></li>
                        <li><a href="#">Vertical</a></li>
                    </ul>
                </li>
-->
            </ul>
        </div>
    </div>
</div>
