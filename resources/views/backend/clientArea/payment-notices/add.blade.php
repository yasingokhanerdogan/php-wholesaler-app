@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Ödeme Bildirimi Yap | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ödeme Bildirimi Yap</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item"><a href="{{ url("backend.client.paymentNotices") }}">Ödeme Bildirimlerim</a></li>
                                <li class="breadcrumb-item active">Ödeme Bildirimi Yap</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ url("backend.client.paymentNotice.create") }}" id="createPaymentNoticeForm">
                                <input type="hidden" value="{{ $authUser->id }}" name="user_id" style="display: none;">

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="bank_account" class="col-form-label">Fiyat Göster*</label>
                                        <select class="form-control" id="bank_account" name="bank_account">
                                            <option value="">Bank Seçin.</option>
                                            @foreach($bank_accounts as $item)
                                                <option value="{{ $item->bank_name }}"> {{ $item->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_amount" class="col-form-label">Ödeme Tutarı*</label>
                                        <span class="text-muted"> (Orn.1000.00₺)</span>
                                        <input class="form-control" type="number"
                                               value=""
                                               id="total_amount"
                                               name="total_amount"
                                               placeholder="Ödeme Tutarı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="order_no" class="col-form-label">Sipariş No*</label>
                                        <select class="form-control" id="order_no" name="order_no">
                                            <option value="">Sipariş No Seçin.</option>
                                            @foreach($orders as $item)
                                                <option value="{{ $item->order_no }}"> #{{ $item->order_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Ad Soyad*</label>
                                        <input class="form-control" type="text"
                                               value="{{ $authUser->name . " " . $authUser->surname }}"
                                               id="name"
                                               name="name"
                                               placeholder="Ad Soyad">
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_name" class="col-form-label">Şirket Adı*</label>
                                        <input class="form-control" type="text"
                                               value="{{ $authUser->company_name }}"
                                               id="company_name"
                                               name="company_name"
                                               placeholder="Şirket Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email*</label>
                                        <input class="form-control" type="text"
                                               value="{{ $authUser->email }}"
                                               id="email"
                                               name="email" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="col-form-label">Telefon*</label>
                                        <input class="form-control" type="number"
                                               value="{{ $authUser->phone }}"
                                               id="phone"
                                               name="phone"
                                               placeholder="Telefon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="identity_number" class="col-form-label">TC Kimlik No*</label>
                                        <input class="form-control" type="number"
                                               value="{{ $authUser->identity_number }}"
                                               id="identity_number"
                                               name="identity_number"
                                               placeholder="TC Kimlik No">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" id="createPaymentNotice" class="btn btn-primary w-md">Gönder
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
