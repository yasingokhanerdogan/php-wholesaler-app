@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Kullanıcı Ekle | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Kullanıcılar Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                                <li class="breadcrumb-item active">Kullanıcı Ekle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="mt-5 mb-5 row">
                                <label class="col-md-2 col-form-label">Kullanıcı Tipi*</label>
                                <div class="col-md-10">
                                    <select class="form-select" id="createAreaUserRole">
                                        <option value="">Kullanıcı Tipi Seçin.</option>
                                        <option value="admin">Yönetici</option>
                                        <option value="client">Müşteri</option>
                                    </select>
                                </div>
                            </div>

                            <div id="createAdmin">
                                <form method="POST" action="{{ url("backend.admin.users.createAdmin") }}"
                                      id="createAdminForm">
                                    <h3 class="mb-4 card-title">Kullanıcı Giriş Bilgileri</h3>
                                    <div class="row">
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Yetki Tipi*</label>
                                            <div class="col-md-10">
                                                <select class="form-select" id="role" name="role">
                                                    <option value="">Yetki Seçin.</option>
                                                    <option value="staff">Personel</option>
                                                    <option value="admin">Yönetici</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="name" class="col-md-2 col-form-label">Ad*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="name" name="name"
                                                       placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="surname" class="col-md-2 col-form-label">Soyad*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="surname" name="surname"
                                                       placeholder="Soyad">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="username" class="col-md-2 col-form-label">Kullanıcı Adı*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="username" name="username"
                                                       placeholder="Kullanıcı Adı">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-md-2 col-form-label">Email*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="email" name="email"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="password" class="col-md-2 col-form-label">Şifre*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" id="password"
                                                       name="password" placeholder="Şifre">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="identity_number" class="col-md-2 col-form-label">TC Kimlik
                                                No*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" id="identity_number"
                                                       name="identity_number" placeholder="TC Kimlik No" maxlength="11">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="phone" class="col-md-2 col-form-label">Telefon*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" id="phone" name="phone"
                                                       placeholder="Telefon" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="address" class="col-md-2 col-form-label">Adres*</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" type="text" id="address" name="address"
                                                          rows="5" placeholder="Adres"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div id="createClient">
                                <form method="POST" action="{{ url("backend.admin.users.createClient") }}"
                                      id="createClientForm">
                                    <h3 class="mb-4 card-title">Kullanıcı Giriş Bilgileri</h3>
                                    <div class="row">
                                        <div class="mb-3 row">
                                            <label for="nameC" class="col-md-2 col-form-label">Ad*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="nameC" name="name"
                                                       placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="surnameC" class="col-md-2 col-form-label">Soyad*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="surnameC" name="surname"
                                                       placeholder="Soyad">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="usernameC" class="col-md-2 col-form-label">Kullanıcı
                                                Adı*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="usernameC" name="username"
                                                       placeholder="Kullanıcı Adı">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="emailC" class="col-md-2 col-form-label">Email*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="email" id="emailC" name="email"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="passwordC" class="col-md-2 col-form-label">Şifre*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" id="passwordC"
                                                       name="password" placeholder="Şifre">
                                            </div>
                                        </div>
                                    </div>


                                    <h3 class="mt-5 mb-4 card-title">Firma Bilgileri</h3>
                                    <div class="row">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="company_nameC" class="col-form-label">Firma Adı*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" value="" id="company_nameC"
                                                           name="company_name" placeholder="Firma Adı">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="identity_numberC" class="col-form-label">TC Kimlik
                                                    No*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="identity_numberC"
                                                           name="identity_number" maxlength="11"
                                                           placeholder="TC Kimlik No">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="phoneC" class="col-form-label">Telefon*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="phoneC" name="phone"
                                                           maxlength="10" placeholder="Telefon">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="tax_numberC" class="col-form-label">Vergi No*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="tax_numberC"
                                                           name="tax_number" placeholder="Vergi No">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="addressC" class="col-form-label">Adres*</label>
                                                <div class="col-md-12">
                                                        <textarea class="form-control" type="text" rows="5"
                                                                  id="addressC" name="address"
                                                                  placeholder="Adres"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="mb-1 col-md-12">
                                                    <label for="cityC" class="col-form-label">Şehir*</label>
                                                    <input class="form-control" type="text" id="cityC" name="city"
                                                           placeholder="Şehir">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="zip_codeC" class="col-form-label">Posta Kodu*</label>
                                                    <input class="form-control" type="number" id="zip_codeC"
                                                           name="zip_code" placeholder="Posta Kodu">
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
@endsection

