@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Kategoriler | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Kategoriler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Kategoriler</li>
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

                            <form method="POST" action="{{ url("backend.admin.category.create") }}" id="createCategoryForm">
                                <div class="row">
                                    <div class="text-center mb-3">
                                        <label for="title" class="col-form-label">Kategori Adı*</label>
                                        <input class="form-control" type="text"
                                               value=""
                                               id="title"
                                               name="title"
                                               placeholder="Kategori Adı">
                                    </div>
                                </div>

                                <div class="mt-1">
                                    <button type="submit" id="createCategory" class="btn btn-primary w-md">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> <!-- end row -->

            <div id="categoryArea"></div>

        </div> <!-- container-fluid -->
    </div>

@endsection
