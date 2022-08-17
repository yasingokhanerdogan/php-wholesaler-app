@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Banka Hesapları | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Banka Hesaplarımız</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Banka Hesaplarımız</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @foreach($bank_accounts as $item)
                    <div class="col-xl-6 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body p-5">
                                <h5 class="font-size-21 mb-2"><span class="text-dark">{{ $item->bank_name }}</span> <span class="fw-bold">(₺)</span></h5>
                                <h5 class="font-size-15 mb-2">Hesap Sahibi: <span class="text-dark">{{ $item->account_owner }}</span></h5>
                                <p class="font-size-17 text-muted mb-2">IBAN: {{ $item->iban }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
