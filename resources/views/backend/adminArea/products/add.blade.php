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
                        <h4 class="mb-0">Ürün Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                                <li class="breadcrumb-item active">Ürün Ekle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="create_product_area">
                                <form method="POST" action="{{ url("backend.admin.product.create") }}" id="createProductForm" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kategori*</label>
                                                <select class="form-control select2" id="category_id"
                                                        name="category_id">
                                                    <option value="">Kategori Seçin.</option>
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
                                                    <option value="">Menşei Seçin.</option>
                                                    <option value="domestic">Yerli</option>
                                                    <option value="imported">İthal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="col-form-label">Ürün Başlığı*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text"
                                                           id="title"
                                                           name="title"
                                                           placeholder="Ürün Başlığı">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="stock" class="col-form-label">Stok*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number"
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
                                                        <option value="0">0%</option>
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
                                            <div class="mb-3 col-md-4">
                                                <label for="product_code"
                                                       class="col-form-label">Ürün Kodu*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text"
                                                           id="product_code"
                                                           name="product_code"
                                                           placeholder="Ürün Kodu">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="images"
                                                       class="col-form-label">Ürün Resmi*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="file"
                                                           id="images"
                                                           name="images[]" multiple>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="color"
                                                       class="col-form-label">Renk Kodu*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control color" type="text"
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
                                                              placeholder="Ön Bilgi"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="properties" class="col-form-label">Özellikler*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="properties"
                                                              name="properties" placeholder="Özellikler"
                                                              rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="description"
                                                       class="col-form-label">Açıklama*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="description"
                                                              name="description"
                                                              placeholder="Açıklama" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="shipping_and_returns"
                                                       class="col-form-label">Kargo ve İade*</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control"
                                                              id="shipping_and_returns"
                                                              name="shipping_and_returns"
                                                              placeholder="Kargo ve İade" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <script src="/public/backend-assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="/public/backend-assets/js/pages/form-editor.init.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#info'));
        ClassicEditor.create(document.querySelector('#description'));
        ClassicEditor.create(document.querySelector('#properties'));
        ClassicEditor.create(document.querySelector('#shipping_and_returns'));
    </script>
@endsection


