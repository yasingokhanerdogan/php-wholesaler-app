@php

    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);

@endphp

        <!doctype html>
<html lang="tr">
<head>
    @include("backend.layouts.dependencies.head")
    <style>
        .whatsapp-support {
            position: fixed;
            bottom: 50px;
            left: 50px;
            width: 45px;
            height: 45px;
            z-index: 9990;
        }

        .whatsapp-support img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div id="layout-wrapper">

    @include("backend.layouts.includes.header")

    @include("backend.layouts.includes.sidebar")

    <div class="main-content">

        @yield("content")

        @include("backend.layouts.includes.footer")
    </div>

</div>

@include("backend.layouts.dependencies.foot")

@if($authUser->role == "client")
    <div class="whatsapp-support">
        <a href="https://wa.me/90{{ $settings->whatsapp }}">
            <img src="/public/backend-assets/uploads/whatsapp.png" alt="#">
        </a>
    </div>
@endif
</body>
</html>
