<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
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

            @if($authUser->role == "client")
                <form method="POST" action="{{ url("backend.client.search") }}"  class="app-search d-none d-lg-block">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                    <div class="position-relative">
                        <input type="text" name="search_input" class="form-control" placeholder="Ürün Ara...">
                        <span class="uil-search"></span>
                    </div>
                </form>
            @endif
        </div>

        <div class="d-flex">

            @if($authUser->role == "client")

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="uil-search"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3" method="POST" action="{{ url("backend.client.search") }}" >
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                    <input type="text" name="search_input" class="form-control" placeholder="Ürün Ara...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="position:relative; top: -2px;">{{ $_SESSION["currency"] }}</span> <i
                                class="uil-angle-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown" style="width: 50px !important;">
                        <div data-simplebar>
                            @if($_SESSION["currency"] == "TL")
                                <a href="{{ url("currency.change", ["currency" => "usd"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">USD</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url("currency.change", ["currency" => "euro"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">EURO</h6>
                                        </div>
                                    </div>
                                </a>
                            @elseif($_SESSION["currency"] == "USD")
                                <a href="{{ url("currency.change", ["currency" => "tl"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">TL</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url("currency.change", ["currency" => "euro"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">EURO</h6>
                                        </div>
                                    </div>
                                </a>
                            @elseif($_SESSION["currency"] == "EURO")
                                <a href="{{ url("currency.change", ["currency" => "tl"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">TL</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url("currency.change", ["currency" => "usd"]) }}"
                                   class="text-center notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">USD</h6>
                                        </div>
                                    </div>
                                </a>
                            @endif


                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" onclick="location.href='{{ url("backend.client.cart") }}'"
                            class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown">
                        <i class="uil-shopping-bag"></i>
                        <span class="badge bg-danger rounded-pill" id="cartCount">{{ $cartCount }}</span>
                    </button>
                </div>

            @endif

                <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                         src="/public/backend-assets/uploads/user.png"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ $authUser->name . " " . $authUser->surname }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    @if($authUser->role == "client")
                        <a class="dropdown-item" href="{{ url("backend.client.profile") }}"><i
                                    class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle">Profil</span></a>
                        <a class="dropdown-item" href="{{ url("frontend.contact") }}"><i
                                    class="uil uil-comment-alt font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle">İletişim</span></a>
                    @else
                        <a class="dropdown-item" href="{{ url("backend.admin.profile") }}"><i
                                    class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle">Profil</span></a>
                    @endif
                    <a class="dropdown-item" href="{{ url("frontend.home") }}"><i
                                class="uil uil-eye font-size-18 align-middle text-muted me-1"></i> <span
                                class="align-middle">Ön Sayfa'ya Dön</span></a>
                    <a class="dropdown-item" href="{{ url("frontend.changePassword.emailScreen") }}"><i
                                class="uil uil-user-check font-size-18 align-middle me-1 text-muted"></i> <span
                                class="align-middle">Şifre Değiştir</span></a>
                    <a class="dropdown-item" href="{{ url("frontend.signout") }}"><i
                                class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                                class="align-middle">Çıkış Yap</span></a>
                </div>
            </div>

            @if($authUser->role != "client")
                <div class="dropdown d-inline-block">
                    <button type="button" onclick="location.href='{{ url("backend.admin.settings") }}'" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="uil-cog"></i>
                    </button>
                </div>
            @endif
        </div>
    </div>
</header>
