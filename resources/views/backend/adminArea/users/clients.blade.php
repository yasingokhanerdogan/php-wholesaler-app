@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Müşteriler | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Müşteri Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Müşteriler</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-4">
                    <button type="button" onclick="location.href='{{ url("backend.admin.users.add") }}'" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Kullanıcı Ekle</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div id="clientUserArea"></div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

