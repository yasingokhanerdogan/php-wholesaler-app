@php
    $settings = \App\Models\SettingModel::find(0);
@endphp
        <!doctype html>
<html lang="tr">
<head>
    <title>Bildirim | {{ $settings->company_name }}</title>
    @include("backend.layouts.dependencies.head")
</head>

<body>

<div class="my-5 pt-sm-5">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-sm-4">
                                <div class="error-img">
                                    <img src="/public/backend-assets/images/404-error.png" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-4 font-size-24">{{ $_message }}</h4>
                    <div class="mt-5">
<!--
                            @if ($message == "giris-linki-gonderildi")

                                <a class="btn btn-primary waves-effect waves-light" href="javascript:window.close();">Kapat</a>

                            @elseif ($message == "giris-linki-gonderilemedi")

                                <a class="btn btn-primary waves-effect waves-light" href="{{ url("frontend.contact") }}">İletişime Geç</a>

                            @elseif ($message == "urun-linki-gonderildi")

                                <a class="btn btn-primary waves-effect waves-light" href="javascript:window.close();">Kapat</a>

                            @elseif ($message == "urun-linki-gonderilemedi")

                                <a class="btn btn-primary waves-effect waves-light" href="{{ url("frontend.contact") }}">İletişime Geç</a>

                            @elseif ($message == "link-kullanilmis")

                                <a class="btn btn-primary waves-effect waves-light" href="javascript:window.close();">Kapat</a>

                            @elseif ($message == "kullanici-bulunamadi")

                                <a class="btn btn-primary waves-effect waves-light" href="javascript:window.history.back()">Geri Dön</a>

                            @elseif ($message == "sifirlama-linki-gonderildi")

                                <a class="btn btn-primary waves-effect waves-light" href="javascript:window.close();">Kapat</a>

                            @elseif ($message == "sifre-sifirlama-linki-gonderilemedi")

                                <a class="btn btn-primary waves-effect waves-light" href="{{ url("frontend.contact") }}">İletişime Geç</a>

                            @elseif ($message == "sifre-degistirildi")

                                @if(isset($_SESSION["user"]["id"]))
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ url("backend.client.home") }}">Panele Git</a>
                                @else
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ url("frontend.login") }}">Giriş Yap</a>
                                @endif

                            @endif

    -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include("backend.layouts.dependencies.foot")
</body>
</html>
