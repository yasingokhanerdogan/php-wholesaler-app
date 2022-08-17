@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Kategori Düzenle | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Kategori Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active"><a href="{{ url("backend.admin.categories") }}">Kategoriler</a></li>
                                <li class="breadcrumb-item active">Kategori Düzenle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ url("backend.admin.category.update") }}" id="updateCategoryForm">
                                <div class="row">
                                    <div class="text-center mb-3">
                                        <label for="title" class="col-form-label">Kategori Adı*</label>
                                        <input class="form-control" type="text"
                                               value="{{ $category->title }}"
                                               id="title"
                                               name="title"
                                               placeholder="Kategori Adı">
                                    </div>
                                </div>
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <div class="mt-1">
                                    <button type="submit" id="updateCategory" class="btn btn-primary w-md">Kaydet</button>
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
