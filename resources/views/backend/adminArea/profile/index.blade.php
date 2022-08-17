@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Profilim | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Profil</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="#">
                                <input type="hidden" value="{{ $authUser->id }}"
                                       name="user_id" style="display: none;">
                                <h3 class="mb-4 card-title">Kullanıcı Giriş Bilgileri</h3>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3 row">
                                            <label for="name"
                                                   class="col-md-2 col-form-label">Ad
                                                Soyad*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                       value="{{ $authUser->name . " " . $authUser->surname }}"
                                                       id="name"
                                                       name="name"
                                                       placeholder="Ad" disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="username"
                                                   class="col-md-2 col-form-label">Kullanıcı Adı*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                       value="{{ $authUser->username }}"
                                                       id="username"
                                                       name="username"
                                                       placeholder="Kullanıcı Adı" disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email"
                                                   class="col-md-2 col-form-label">Email*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="email"
                                                       value="{{ $authUser->email }}"
                                                       id="email"
                                                       name="email"
                                                       placeholder="Email" disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="role"
                                                   class="col-md-2 col-form-label">Kullanıcı Tipi*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                       value="@if($authUser->role == "staff") Personel @else Yönetici @endif"
                                                       id="role"
                                                       name="role"
                                                       placeholder="Kullanıcı Tipi" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ baseUrl . url("QRLoginSendMail", ["id" => $authUser->id]) }}"
                                             alt="" style="width: 200px; height: 200px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="identity_number" class="col-form-label">TC
                                            Kimlik No*</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="number"
                                                   value="{{ $authUser->identity_number }}"
                                                   id="identity_number"
                                                   name="identity_number" maxlength="11"
                                                   placeholder="TC Kimlik No" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="col-form-label">Telefon*</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="number"
                                                   value="{{ $authUser->phone }}"
                                                   id="phone"
                                                   name="phone"
                                                   placeholder="Telefon" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="address" class="col-form-label">Adres*</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" type="text" rows="5"
                                                      id="address"
                                                      name="address"
                                                      placeholder="Adres"
                                                      disabled>{{ $authUser->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#productInfo'));
        ClassicEditor.create(document.querySelector('#productDescription'));
        ClassicEditor.create(document.querySelector('#productProperties'));
    </script>

@endsection
