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
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Kullanıcı Düzenle</h4>
                            <p class="card-title-desc">Kullanıcı Bilgileri Aşağıda Görüntülenmektedir!</p>

                            @if ($userData->role == "admin" || $userData->role == "staff")

                            <div id="editAdmin">
                                <form method="POST" action="{{ url("backend.admin.users.updateAdmin") }}"
                                      id="editAdminForm">
                                    <input type="hidden" value="{{ $userData->id }}" name="user_id">
                                    <h3 class="mb-4 card-title">Kullanıcı Giriş Bilgileri</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3 row">
                                                        <label for="name" class="col-md-3 col-form-label">Ad*</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="name" name="name"
                                                                   placeholder="Ad" value="{{ $userData->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="surname" class="col-md-3 col-form-label">Soyad*</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="surname" name="surname"
                                                                   placeholder="Soyad" value="{{ $userData->surname }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="username" class="col-md-3 col-form-label">Kullanıcı Adı*</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="username" name="username"
                                                                   placeholder="Kullanıcı Adı" value="{{ $userData->username }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="email" class="col-md-3 col-form-label">Email*</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="email" name="email"
                                                                   placeholder="Email" value="{{ $userData->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ baseUrl . url("QRLoginSendMail", ["id" => $authUser->id]) }}"
                                                         alt="" style="width: 200px; height: 200px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="password" class="col-md-2 col-form-label">Şifre*</label>
                                            <div class="col-md-4">
                                                <button class="btn btn-info" type="button" id="resetPassword_sendMail_button" email="{{ $userData->email }}">Sıfırlama Linki Gönder</button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="identity_number" class="col-md-2 col-form-label">TC Kimlik
                                                No*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" id="identity_number"
                                                       name="identity_number" placeholder="TC Kimlik No" maxlength="11" value="{{ $userData->identity_number }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="phone" class="col-md-2 col-form-label">Telefon*</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" id="phone" name="phone"
                                                       placeholder="Telefon" maxlength="10" value="{{ $userData->phone }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="address" class="col-md-2 col-form-label">Adres*</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" type="text" id="address" name="address"
                                                          rows="5" placeholder="Adres">{{ $userData->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="statusA" class="col-md-2 col-form-label">Durumu*</label>
                                            <div class="col-md-5">
                                                <select class="form-control" id="statusA" name="status">
                                                    @if ($userData->status == "0")
                                                        <option value="0">Pasif</option>
                                                        <option value="1">Aktif</option>
                                                    @else
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Pasif</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="role" class="col-md-2 col-form-label">Yetki*</label>
                                            <div class="col-md-5">
                                                <select class="form-control" id="role" name="role">
                                                    @if ($userData->role == "admin")
                                                    <option value="admin">Yönetici</option>
                                                    <option value="staff">Personel</option>
                                                    @elseif($userData->role == "staff")
                                                    <option value="staff">Personel</option>
                                                    <option value="admin">Yönetici</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            @elseif ($userData->role == "client")

                                <div id="editClient">
                                <form method="POST" action="{{ url("backend.admin.users.updateClient") }}"
                                      id="editClientForm">
                                    <input type="hidden" value="{{ $userData->id }}" name="user_id">
                                    <h3 class="mb-4 card-title">Kullanıcı Giriş Bilgileri</h3>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3 row">
                                                <label for="nameC" class="col-md-3 col-form-label">Ad*</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" id="nameC" name="name"
                                                           placeholder="Ad" value="{{ $userData->name }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="surnameC" class="col-md-3 col-form-label">Soyad*</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" id="surnameC" name="surname"
                                                           placeholder="Soyad" value="{{ $userData->surname }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="usernameC" class="col-md-3 col-form-label">Kullanıcı
                                                    Adı*</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" id="usernameC" name="username"
                                                           placeholder="Kullanıcı Adı" value="{{ $userData->username }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="emailC" class="col-md-3 col-form-label">Email*</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="email" id="emailC" name="email"
                                                           placeholder="Email" value="{{ $userData->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ baseUrl . url("QRLoginSendMail", ["id" => $userData->id]) }}"
                                                 alt="" style="width: 200px; height: 200px;">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="passwordC" class="col-md-2 col-form-label">Şifre*</label>
                                            <div class="col-md-4">
                                                <button class="btn btn-info" type="button" id="resetPassword_sendMail_button" email="{{ $userData->email }}">Sıfırlama Linki Gönder</button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="statusC" class="col-md-2 col-form-label">Durumu*</label>
                                            <div class="col-md-5">
                                                <select class="form-control" id="statusC" name="status">
                                                    @if ($userData->status == "0")
                                                        <option value="0">Pasif</option>
                                                        <option value="1">Aktif</option>
                                                    @else
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Pasif</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <h3 class="mt-5 mb-4 card-title">Firma Bilgileri</h3>
                                    <div class="row">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="company_nameC" class="col-form-label">Firma Adı*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" id="company_nameC"
                                                           name="company_name" placeholder="Firma Adı" value="{{ $userData->company_name }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="identity_numberC" class="col-form-label">TC Kimlik
                                                    No*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="identity_numberC"
                                                           name="identity_number" maxlength="11"
                                                           placeholder="TC Kimlik No"  value="{{ $userData->identity_number }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="phoneC" class="col-form-label">Telefon*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="phoneC" name="phone"
                                                           maxlength="10" placeholder="Telefon" value="{{ $userData->phone }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="tax_numberC" class="col-form-label">Vergi No*</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="number" id="tax_numberC"
                                                           name="tax_number" placeholder="Vergi No" value="{{ $userData->tax_number }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="addressC" class="col-form-label">Adres*</label>
                                                <div class="col-md-12">
                                                        <textarea class="form-control" type="text" rows="5"
                                                                  id="addressC" name="address"
                                                                  placeholder="Adres">{{ $userData->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="mb-1 col-md-12">
                                                    <label for="cityC" class="col-form-label">Şehir*</label>
                                                    <input class="form-control" type="text" id="cityC" name="city"
                                                           placeholder="Şehir" value="{{ $userData->city }}">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="zip_codeC" class="col-form-label">Posta Kodu*</label>
                                                    <input class="form-control" type="number" id="zip_codeC"
                                                           name="zip_code" placeholder="Posta Kodu" value="{{ $userData->zip_code }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

