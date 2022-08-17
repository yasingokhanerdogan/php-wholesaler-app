@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Ürünler | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ürünler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Ürünler</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                @if($products)

                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom">
                                <h5 class="mb-0">Kategoriler</h5>
                            </div>

                            <div class="p-4">
                                @foreach($categories as $category)
                                    @if($category->getProducts->count() > 0)
                                        <a class="text-body fw-semibold pb-2 d-block"
                                           href="{{ url("backend.client.category", ["slug" => $category->slug]) }}"
                                           role="button">
                                            {{ $category->title }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-xl-9 col-lg-8"> -->

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($products as $product)
                                        @if($product->getCategory->status == "1")
                                            <div class="col-xl-4 col-sm-6">
                                                <div class="product-box">
                                                    <div class="product-img pt-4 px-4">
                                                        @if($authUser->show_price == "1")
                                                            @if($product->stock != 0)
                                                                @if($product->discount_rate != 0)
                                                                    <div class="product-ribbon badge bg-success">
                                                                        - {{ $product->discount_rate }}%
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="product-ribbon badge bg-danger">
                                                                    Stokta Yok
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <a href="{{ url("backend.client.product.detail", ["slug" => $product->slug]) }}">
                                                            @foreach($product->getImages as $image)
                                                                @if($image->rank == 0)
                                                                    <img src="{{ $image->image }}" alt=""
                                                                         style="height: 200px"
                                                                         class="img-fluid mx-auto d-block">
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    </div>

                                                    <div class="text-center product-content p-4">

                                                        <h5 class="mb-1"><a
                                                                    href="{{ url("backend.client.product.detail", ["slug" => $product->slug]) }}"
                                                                    class="text-dark">{{ $product->title }}</a>
                                                        </h5>
                                                        <p class="text-muted font-size-13">{{ $product->getCategory->title }}</p>

                                                        @if($authUser->show_price == "1")
                                                            @if($product->discount_rate == 0)
                                                                <h5 class="mt-3 mb-0">
                                                                    {{ numberFormat($product->real_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}
                                                                </h5>
                                                            @else
                                                                <h5 class="mt-3 mb-0">
                                                                    <span class="text-muted me-2"><del>{{ numberFormat($product->real_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}</del></span>
                                                                    {{ numberFormat($product->discounted_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}
                                                                </h5>
                                                            @endif
                                                        @endif
                                                        @if($product->otherProducts->count() > 0)
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Renkler :
                                                                </li>
                                                                @foreach($product->otherProducts as $otherProduct)
                                                                    <li class="list-inline-item">
                                                                        <i class="mdi mdi-circle"
                                                                           style="color: {{ $otherProduct->color }};"></i>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <!-- end row -->

                                @if($pagination["pageCount"] != 1)
                                    <div class="row mt-4">
                                        @if($pagination["page"] != 1)
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-sm-0">{{ $pagination["page"] }}.Sayfa</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                @else
                                                    <div class="col-sm-12">
                                                        @endif
                                                        <div class="float-sm-end">
                                                            <ul class="pagination pagination-rounded mb-sm-0">

                                                                @if ($pagination["page"] != 1)
                                                                    <li class="page-item">
                                                                        <a href="{{ url("backend.client.products", ["page" => "1"]) }}"
                                                                           class="page-link">İlk</a>
                                                                    </li>
                                                                @endif

                                                                @for ($i = $pagination["page"] - $pagination["forlimit"]; $i < $pagination["page"] + $pagination["forlimit"] + 1; $i++)

                                                                    @if ($i > 0 && $i <= $pagination["pageCount"])

                                                                        @if ($i == $pagination["page"])

                                                                            <li class="page-item active">
                                                                                <a href="javascript:void(0);"
                                                                                   class="page-link"> {{ $i }}</a>
                                                                            </li>

                                                                        @else

                                                                            <li class="page-item">
                                                                                <a href="{{ url("backend.client.products", ["page" => $i]) }}"
                                                                                   class="page-link">{{ $i }}</a>
                                                                            </li>

                                                                        @endif
                                                                    @endif
                                                                @endfor

                                                                @if ($pagination["page"] != $pagination["pageCount"])

                                                                    <li class="page-item">
                                                                        <a href="{{ url("backend.client.products", ["page" => $pagination["pageCount"]]) }}"
                                                                           class="page-link">Son</a>
                                                                    </li>
                                                                @endif

                                                            </ul>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <h3 class="text-center mt-3 mb-3">Ürün Bulunamadı!</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection




