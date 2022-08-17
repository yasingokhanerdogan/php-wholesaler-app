@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Ürün Ekle | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ürün Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                                <li class="breadcrumb-item active">Ürün Düzenle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            @if($product)
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div id="create_product_area">
                                    <form method="POST" action="{{ url("backend.admin.product.update") }}"
                                          id="updateProductForm" enctype="multipart/form-data">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori*</label>
                                                    <select class="form-control select2" id="category_id"
                                                            name="category_id">
                                                        <option value="{{ $product->getCategory->id }}">{{ $product->getCategory->title }}</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id}}">{{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Menşei*</label>
                                                    <select class="form-control select2" id="origin"
                                                            name="origin">
                                                        @if($product->origin == "domestic")
                                                            <option value="domestic">Yerli</option>
                                                            <option value="imported">İthal</option>
                                                        @else
                                                            <option value="imported">İthal</option>
                                                            <option value="domestic">Yerli</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="col-form-label">Ürün Başlığı*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text"
                                                           value="{{ $product->title }}"
                                                           id="title"
                                                           name="title"
                                                           placeholder="Ürün Başlığı">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="stock" class="col-form-label">Stok*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number"
                                                           value="{{ $product->stock }}"
                                                           id="stock"
                                                           name="stock"
                                                           placeholder="Stok">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="real_price" class="col-form-label">Fiyat (₺)*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number"
                                                           value="{{ $product->real_price }}"
                                                           id="real_price"
                                                           name="real_price"
                                                           placeholder="Fiyat">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="discount_rate"
                                                       class="col-form-label">İndirim Oranı(%)</label>
                                                <div class="col-md-12">
                                                    <select class="form-control select2" id="discount_rate"
                                                            name="discount_rate">
                                                        <option value="{{ $product->discount_rate }}">{{ $product->discount_rate }}
                                                            %
                                                        </option>
                                                        @if($product->discount_rate != 0)
                                                            <option value="0">0%</option> @endif
                                                        <option value="5">5%</option>
                                                        <option value="10">10%</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                        <option value="25">25%</option>
                                                        <option value="30">30%</option>
                                                        <option value="35">35%</option>
                                                        <option value="40">40%</option>
                                                        <option value="45">45%</option>
                                                        <option value="50">50%</option>
                                                        <option value="55">55%</option>
                                                        <option value="60">60%</option>
                                                        <option value="65">65%</option>
                                                        <option value="70">70%</option>
                                                        <option value="75">75%</option>
                                                        <option value="80">80%</option>
                                                        <option value="85">85%</option>
                                                        <option value="90">90%</option>
                                                        <option value="95">95%</option>
                                                        <option value="100">100%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="product_code"
                                                       class="col-form-label">Ürün Kodu*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text"
                                                           value="{{ $product->product_code }}"
                                                           id="product_code"
                                                           name="product_code"
                                                           placeholder="Ürün Kodu">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="color"
                                                       class="col-form-label">Renk Kodu*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control color" type="text"
                                                           value="{{ $product->color }}"
                                                           id="colorpicker-showinput-intial"
                                                           name="color"
                                                           placeholder="Renk Kodu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="info" class="col-form-label">Ön Bilgi*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="info"
                                                              name="info" rows="3"
                                                              placeholder="Ön Bilgi">{{ $product->info }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="properties" class="col-form-label">Özellikler*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="properties"
                                                              name="properties" placeholder="Özellikler"
                                                              rows="5">{{ $product->properties }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="description"
                                                       class="col-form-label">Açıklama*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="description"
                                                              name="description"
                                                              placeholder="Açıklama"
                                                              rows="5">{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="shipping_and_returns"
                                                       class="col-form-label">Kargo ve İade*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="shipping_and_returns"
                                                              name="shipping_and_returns"
                                                              placeholder="Kargo ve İade"
                                                              rows="5">{{ $product->shipping_and_returns }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <form method="POST" action="{{ url("backend.admin.product.createImage") }}"
                                          id="createProductImageForm" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="file" name="img[]" class="form-control mb-2" required multiple>
                                            <input type="hidden" name="product_id" value="{{ $images[0]->product_id }}">
                                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                            <button class="px-3 btn btn-success" id="createProductImageButton"><i
                                                        class="uil uil-plus"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="table-responsive mb-4">
                                        <table class="table table-centered dt-responsive nowrap table-card-list"
                                               style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Sıra</th>
                                                <th>Görüntü</th>
                                                @if(count($images) > 1)
                                                    <th>İşlemler</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody class="sortable">
                                            @foreach ($images as $item)

                                                <tr id="ord-{{ $item->id }}">
                                                    <td>{{ $item->rank + 1 }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <img src="{{ $item->image }}" alt="#">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(count($images) > 1)
                                                            <button type="button" class="px-3 btn btn-danger"
                                                                    id="deleteProductImageButton"
                                                                    image-id="{{ $item->id }}"><i
                                                                        class="uil uil-trash-alt"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center mt-3 mb-3">Ürün Bulunamadı!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div> <!-- container-fluid -->
    </div>
    <script src="/public/backend-assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#info'));
        ClassicEditor.create(document.querySelector('#description'));
        ClassicEditor.create(document.querySelector('#properties'));
        ClassicEditor.create(document.querySelector('#shipping_and_returns'));
    </script>
@endsection


