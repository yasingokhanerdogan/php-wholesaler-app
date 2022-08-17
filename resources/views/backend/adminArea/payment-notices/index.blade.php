@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Ödeme Bildirimleri Listesi | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ödeme Bildirimleri Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Ödeme Bildirimleri Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row mb-3">
                <div class="col-md-3">
                    <button type="button" id="refresh_lists" class="btn btn-warning"> Listeyi Güncelle</button>
                </div>
            </div>

            <div id="paymentNoticeAdminArea"></div>

        </div> <!-- container-fluid -->
    </div>

@endsection
