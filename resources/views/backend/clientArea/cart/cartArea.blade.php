<div class="row">
    @if($cart->count() > 0)
        <form method="POST" action="{{ url("backend.client.cart.updateCart") }}">
            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-xl-8">
                    @foreach($cart as $item)
                        <div class="card border shadow-none">
                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="{{ $item->getProductImages[0]->image }}" alt="" class="avatar-lg">
                                    </div>
                                    <div class="flex-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-16">
                                                <a href="{{ url("backend.client.product.detail", ["slug" => $item->getProduct->slug]) }}"
                                                   class="text-dark">{{ $item->getProduct->title }}</a>
                                            </h5>
                                            <p class="mb-1">{!! substr($item->getProduct->info, 0, 100) !!}...</p>
                                            <div style="width: 25px; height: 25px; border-radius: 50%; background-color: {{ $item->getProduct->color }}"></div>
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" id="deleteFromCart"
                                                   product-id="{{ $item->product_id }}" class="text-muted px-2">
                                                    <i class="uil uil-trash-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Metrekare Fiyatı</p>
                                                @if($item->getProduct->discount_rate != 0)
                                                    <h5 class="font-size-16 float-start text-muted">
                                                        <del>{{ numberFormat($item->getProduct->real_price) }}₺
                                                        </del>
                                                    </h5>
                                                    <h5 class="font-size-16">{{ numberFormat($item->getProduct->discounted_price) }}
                                                        ₺</h5>
                                                @else
                                                    <h5 class="font-size-16">{{ numberFormat($item->getProduct->real_price) }}
                                                        ₺</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Metrekare</p>
                                                <div style="width: 110px;" class="product-cart-touchspin">
                                                    <input data-toggle="touchspin" type="text" id="productAmount"
                                                           name="product-{{ $item->product_id }}"
                                                           value="{{ $item->product_amount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Toplam Fiyat</p>
                                                <h5 class="font-size-16">{{ numberFormat($item->getProduct->discounted_price * $item->product_amount) }}
                                                    ₺</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    <div class="row mt-4 mb-4">
                        <div class="col-sm-12">
                            <a href="{{ url("backend.client.products") }}" class="btn btn-link text-muted">
                                <i class="uil uil-arrow-left me-1"></i> Alışverişe Devam Et </a>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>

                <div class="col-xl-4">
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                        <tr>
                                            <td>Ara Toplam :</td>
                                            <td class="text-end">{{ numberFormat($paymentInfo["sub_total"]) }}₺</td>
                                        </tr>
                                        <tr>
                                            <td>İndirim :</td>
                                            <td class="text-end">
                                                - {{ numberFormat($paymentInfo["total_discount"]) }}₺
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kargo :</td>
                                            <td class="text-end">Alıcı Ödemeli</td>
                                        </tr>
                                        <tr>
                                            <td>Vergi(18%) :</td>
                                            <td class="text-end">{{ numberFormat($paymentInfo["tax_total"]) }}₺</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Genel Toplam :</th>
                                            <td class="text-end">
                                            <span class="fw-bold">
                                               {{ numberFormat($paymentInfo["total"]) }}₺
                                            </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end mt-2 mt-sm-0 float-start">
                                <button type="submit" class="btn btn-warning">
                                    <i class="uil uil-refresh me-1"></i> Sepeti Güncelle
                                </button>
                            </div>
                            <div class="text-sm-end mt-2 mt-sm-0">
                                <a href="{{ url("backend.client.cart.checkout") }}" class="btn btn-success">
                                    <i class="uil uil-shopping-cart-alt me-1"></i> Devam Et </a>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="card border shadow-none">
            <div class="card-body">
                <h5 class="font-size-22 mt-3 mb-3 text-center">Sepetiniz Boş!</h5>
            </div>
        </div>
    @endif
</div>


<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>