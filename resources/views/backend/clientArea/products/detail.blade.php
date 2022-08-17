@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "$product->title | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">{{ $product->title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item"><a href="{{ url("backend.client.products") }}">Ürünler</a></li>
                                <li class="breadcrumb-item active">{{ $product->title }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="product-detail">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                     aria-orientation="vertical">
                                                    @for($i=0; $i < count($product->getImages); $i++)
                                                        <a class="nav-link @if($i == 0) active @endif"
                                                           id="image-{{ $i+1 }}-tab" data-bs-toggle="pill"
                                                           href="#image-{{ $i+1 }}" role="tab">
                                                            <img src="{{ $product->getImages[$i]->image }}" alt=""
                                                                 class="img-fluid mx-auto d-block tab-img rounded">
                                                        </a>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="col-9">
                                                <div class="tab-content position-relative" id="v-pills-tabContent">

                                                    <div class="product-wishlist"
                                                         style="padding-top: 15px; padding-right: 15px;">
                                                        <a target="_blank"
                                                           href="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ baseUrl . url("QRViewProductSendMail", ["user_id" => $authUser->id, "product_id" => $product->id]) }}">
                                                            <i class="font-size-22 mdi mdi-qrcode-scan text-white"></i>
                                                        </a>
                                                    </div>

                                                    @for($i=0; $i < count($product->getImages); $i++)
                                                        <div class="tab-pane fade  @if($i == 0) show active @endif"
                                                             id="image-{{ $i+1 }}" role="tabpanel">
                                                            <div class="product-img">
                                                                <img src="{{ $product->getImages[$i]->image }}" alt=""
                                                                     class="img-fluid mx-auto d-block"
                                                                     data-zoom="{{ $product->getImages[$i]->image }}">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                @if($authUser->show_price == "1")
                                                    @if($product->stock != 0)
                                                        <div class="row text-center mt-2">
                                                            <div class="col-sm-12 d-grid">
                                                                <button type="button" id="addToCart"
                                                                        product-id="{{ $product->id }}"
                                                                        class="btn btn-primary btn-block waves-effect waves-light mt-2 me-1">
                                                                    <i class="uil uil-shopping-cart-alt me-2"></i>
                                                                    Sepete Ekle
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-7">
                                    <div class="mt-4 mt-xl-3 ps-xl-4">
                                        <h5 class="font-size-14"><a href="{{ url("backend.client.category", ["slug" => $product->getCategory->slug]) }}" class="text-muted">{{ $product->getCategory->title }}</a></h5>
                                        <h4 class="font-size-20 mb-3">{{ $product->title }}</h4>

                                        @if($product->stock != 0)
                                            <h6 class="mt-2 pt-1">Stok: {{ $product->stock }}m2</h6>
                                        @else
                                            <h6 class="mt-2 pt-1 font-size-18 text-danger">Stokta Yok</h6>
                                        @endif

                                        @if($authUser->show_price == "1")
                                            @if($product->stock != 0)
                                                @if($product->discount_rate == 0)
                                                    <h5 class="mt-1 pt-1">
                                                        {{ numberFormat($product->real_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}
                                                    </h5>
                                                @else
                                                    <h5 class="mt-1 pt-1">
                                                        <span class="text-muted me-2"><del>{{ numberFormat($product->real_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}</del></span>
                                                        {{ numberFormat($product->discounted_price / $_SESSION["currencyValue"]) }}{{ $_SESSION["currencyIcon"] }}
                                                        <span class="text-danger font-size-14 ms-2">- {{ $product->discount_rate }}% İndirim</span>
                                                    </h5>
                                                @endif
                                            @endif
                                        @endif

                                        <p class="mt-4 text-muted">{!! $product->info  !!}</p>

                                        <div class="row">
                                            @if($authUser->show_price == "1")
                                                @if($product->stock != 0)
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="mt-3 mb-3">
                                                            <label for="productAmount"
                                                                   class="form-label">Metrekare</label>
                                                            <input data-toggle="touchspin" type="text" value="1"
                                                                   id="productAmount">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="col-lg-7 col-sm-8">
                                                <div class="product-desc-color mt-3">
                                                    <h5 class="font-size-14">Renkler :</h5>
                                                    <ul class="list-inline">
                                                        @foreach($product->otherProducts as $otherProduct)
                                                            <li class="list-inline-item">
                                                                <a href="{{ url("backend.client.product.detail", ["slug" => $otherProduct->slug]) }}"
                                                                   @if($product->id == $otherProduct->id) class="active"
                                                                   @endif data-bs-toggle="tooltip"
                                                                   data-bs-placement="top">
                                                                    <div class="product-color-item">
                                                                        <img src="{{ $otherProduct->getImages[0]->image }}"
                                                                             alt="{{ $otherProduct->title }}"
                                                                             title="{{ $otherProduct->title }}"
                                                                             class="avatar-md">
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="mt-4">
                                <div class="product-desc">
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                               href="#description"
                                               role="tab">Açıklama</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="properties-tab" data-bs-toggle="tab"
                                               href="#properties" role="tab">Özellikler</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="shipping-and-returns-tab" data-bs-toggle="tab"
                                               href="#shipping-and-returns"
                                               role="tab">Kargo ve İade</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-4">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                        <div class="tab-pane fade" id="properties" role="tabpanel">
                                            <p>{!! $product->properties !!}</p>
                                        </div>
                                        <div class="tab-pane fade" id="shipping-and-returns" role="tabpanel">
                                            <p>{!! $product->shipping_and_returns !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection




