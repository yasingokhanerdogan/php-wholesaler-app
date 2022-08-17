@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Sipariş Durumu | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <style>
                    .status {
                        color: #88B04B;
                        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                        font-weight: 900;
                        font-size: 40px;
                        margin-bottom: 10px;
                    }
                    p {
                        color: #404F5E;
                        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                        font-size:20px;
                        margin: 0;
                    }
                    .checkmark {
                        color: #9ABC66;
                        font-size: 100px;
                        line-height: 200px;
                        margin-left:-15px;
                    }
                    .card {
                        background: white;
                        padding: 60px;
                        border-radius: 4px;
                        box-shadow: 0 2px 3px #C8D0D8;
                        display: inline-block;
                        margin: 0 auto;
                    }
                </style>
                <div class="card">
                    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin: 0 auto; text-align: center">
                        <i class="fa fa-check checkmark"></i>
                    </div>
                    <div class="text-center">
                        <h1 class="status mt-3 mb-5">#{{ $order->order_no }} no'lu Siparişiniz Alınmıştır!</h1>
                        <p><a href="{{ url("backend.client.bankAccounts") }}" target="_blank"> Banka Hesaplarımıza</a> En Geç {{ $order->created_at->modify("+1 day") }} Tarihine Kadar {{ numberFormat($order->total_price) }}₺ EFT / HAVALE Yapınız.</p>
                        <p><a href="{{ url("backend.client.paymentNotice.add") }}" target="_blank">Ödeme Bildirimi</a> Zamanında Yapılmayan Siparişler İptal Edilmektedir! </p>
                        <p><a href="{{ url("backend.client.orders") }}" target="_blank">Siparişlerim</a> Sekmesinden Takip Edebilirsiniz.</p>
                        <p><b>Not:</b> Ödeme Bildirimi Yaptıktan Sonra Siparişi <b>İptal Edemezsiniz</b>!</p>
                        <a href="{{ url("backend.client.products") }}" class="btn btn-info mt-4">Ürünler Sayfasına Git</a>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>

@endsection
