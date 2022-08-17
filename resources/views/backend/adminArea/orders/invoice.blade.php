@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "#$order->order_no no'lu Sipariş Faturası | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16">Sipariş No #{{ $order->order_no }}
                                    @if($order->status == "pending")
                                        <span class="badge bg-pill bg-warning font-size-12">Ödeme Bekleniyor!</span>
                                    @elseif($order->status == "paid")
                                        <span class="badge bg-pill bg-warning font-size-12">Ödeme Bildirimi Yapıldı!</span>
                                    @elseif($order->status == "approved")
                                        <span class="badge bg-pill bg-success font-size-12">Sipariş Onaylandı!</span>
                                    @elseif($order->status == "canceled")
                                        <span class="badge bg-pill bg-danger font-size-12">Sipariş İptal Edildi!</span>
                                    @endif
                                </h4>
                                <div class="mb-4">
                                    <img src="{{ $settings->logo }}" alt="logo" height="100"/>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">{{ $settings->company_name }}</p>
                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> {{ $settings->address }}
                                    </p>
                                    <p><i class="uil uil-phone me-1"></i> {{ $settings->phone }}</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-15 mb-2">{{ $order->name }}</h5>
                                        <span><i class="uil uil-envelope-alt me-1"></i> {{ $order->email }}</span><br>
                                        <span><i class="uil uil-shield me-1"></i> {{ $order->identity_number }}</span><br>
                                        <span><i class="uil uil-phone-alt me-1"></i> {{ $order->phone }}</span><br>
                                        <span><i class="uil uil-location-point me-1"></i> {{ $order->address }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Sipariş No:</h5>
                                            <p>#{{ $order->order_no }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-16 mb-1">Sipariş Tarihi:</h5>
                                            <p>{{ $order->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="py-2">
                                <h5 class="font-size-15">Sipariş Özeti</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered mb-0">
                                        <thead>
                                        <tr>
                                            <th style="width: 70px;">No</th>
                                            <th>Ürün Bilgisi</th>
                                            <th>Fiyat</th>
                                            <th>Miktar</th>
                                            <th class="float-end">Ara Toplam</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $itemRank = 1; @endphp
                                        @foreach($order->getOrderProducts as $item)
                                            <tr>
                                                <th scope="row">{{ $itemRank }}</th>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{ $item->title }}</h5>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">Renk : {{ $item->color }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ numberFormat($item->real_price) }}₺</td>
                                                <td>{{ $item->amount }} m2</td>
                                                <td class="float-end">{{ numberFormat($item->real_price * $item->amount) }}₺</td>
                                            </tr>
                                            @php $itemRank++; @endphp
                                        @endforeach

                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">Ara Toplam</th>
                                            <td class="text-end">{{ numberFormat($order->sub_total) }}₺</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                İndirim :
                                            </th>
                                            <td class="border-0 text-end">- {{ numberFormat($order->total_discount) }}
                                                ₺
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Kargo :
                                            </th>
                                            <td class="border-0 text-end">Alıcı Ödemeli</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Vergi(18%) :
                                            </th>
                                            <td class="border-0 text-end">{{ numberFormat($order->total_tax) }}₺</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Genel Toplam</th>
                                            <td class="border-0 text-end"><h4
                                                        class="m-0">{{ numberFormat($order->total_price) }}₺</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if($order->status == "approved")
                                    <div class="d-print-none mt-4">
                                        <div class="float-end">
                                            <a href="javascript:window.print()"
                                               class="btn btn-success waves-effect waves-light me-1"><i
                                                        class="fa fa-print"></i> Yazdır</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
