@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Ayarlar | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Ayarlar</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8">
                    <form method="POST" action="{{ url("backend.admin.settings.update") }}" id="settingsForm">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#navtabs-general-settings"
                                           role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-cogs"></i></span>
                                            <span class="d-none d-sm-block">Genel Ayarlar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#navtabs-contact" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-address-card"></i></span>
                                            <span class="d-none d-sm-block">İletişim Ayarları</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#navtabs-smtp" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">SMTP Mail Ayarları</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#navtabs-social" role="tab">
                                            <span class="d-block d-sm-none"><i class="fab fa-facebook"></i></span>
                                            <span class="d-none d-sm-block">Sosyal Medya</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#navtabs-about-us" role="tab">
                                            <span class="d-block d-sm-none"><i class="fa fa-address-book"></i></span>
                                            <span class="d-none d-sm-block">Hakkımızda Sayfası</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#navtabs-others" role="tab">
                                            <span class="d-block d-sm-none"><i class="fab fa-google"></i></span>
                                            <span class="d-none d-sm-block">Diğer</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="navtabs-general-settings" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="company_name" class="form-label">Şirket Adı*</label>
                                                    <input type="text" id="company_name" name="company_name" class="form-control"
                                                           value="{{ $settings->company_name }}" placeholder="Şirket Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Site Başlığı*</label>
                                                    <input type="text" id="title" name="title" class="form-control"
                                                           value="{{ $settings->title }}" placeholder="Site Başlığı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Site Açıklaması</label>
                                                    <textarea type="text" id="description" name="description"
                                                              class="form-control" placeholder="Site Açıklaması"
                                                              rows="6">{{ $settings->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="keywords" class="form-label">Site Anahtar
                                                        Kelimeleri*</label>
                                                    <textarea type="text" id="keywords" name="keywords"
                                                              class="form-control" placeholder="Site Anahtar Kelimeleri"
                                                              rows="6">{{ $settings->keywords }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="copyright" class="form-label">Copyright*</label>
                                                    <input type="text" id="copyright" name="copyright"
                                                           class="form-control" value="{!! $settings->copyright  !!}"
                                                           placeholder="Copyright">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-contact" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Telefon*</label>
                                                    <input type="text" id="phone" name="phone" class="form-control"
                                                           value="{{ $settings->phone }}" placeholder="Telefon">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email*</label>
                                                    <input type="text" id="email" name="email" class="form-control"
                                                           value="{{ $settings->email }}" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="city" class="form-label">Şehir*</label>
                                                    <input type="text" id="city" name="city"
                                                           class="form-control" value="{{ $settings->city }}"
                                                           placeholder="Şehir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Adres*</label>
                                                    <textarea type="text" id="address" name="address"
                                                              class="form-control"
                                                              placeholder="Adres">{{ $settings->address }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="whatsapp" class="form-label">Whatsapp Telefon(Orn.5551232323)*</label>
                                                    <input type="text" id="whatsapp" name="whatsapp"
                                                           class="form-control" value="{{ $settings->whatsapp }}"
                                                           placeholder="Whatsapp Telefon(Orn.5551232323)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-smtp" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="smtp_host" class="form-label">SMTP Host*</label>
                                                    <input type="text" id="smtp_host" name="smtp_host"
                                                           class="form-control" value="{{ $settings->smtp_host }}"
                                                           placeholder="Host">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="smtp_port" class="form-label">SMTP Port*</label>
                                                    <input type="text" id="smtp_port" name="smtp_port"
                                                           class="form-control" value="{{ $settings->smtp_port }}"
                                                           placeholder="Port">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="smtp_username" class="form-label">Info Maili SMTP Kullanıcı Adı*</label>
                                                    <input type="text" id="smtp_username" name="smtp_username"
                                                           class="form-control" value="{{ $settings->smtp_username }}"
                                                           placeholder="Kullanıcı Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="contact_smtp_username" class="form-label">İletişim Maili SMTP Kullanıcı Adı*</label>
                                                    <input type="text" id="contact_smtp_username" name="contact_smtp_username"
                                                           class="form-control" value="{{ $settings->contact_smtp_username }}"
                                                           placeholder="Kullanıcı Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="smtp_password" class="form-label">Tek Şifre*</label>
                                                    <input type="password" id="smtp_password" name="smtp_password"
                                                           class="form-control"
                                                           value="{{ base64_decode($settings->smtp_password) }}"
                                                           placeholder="Tek Şifre">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-social" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="facebook" class="form-label">Facebook*</label>
                                                    <input type="text" id="facebook" name="facebook"
                                                           class="form-control" value="{{ $settings->facebook }}"
                                                           placeholder="Facebook">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="twitter" class="form-label">Twitter*</label>
                                                    <input type="text" id="twitter" name="twitter" class="form-control"
                                                           value="{{ $settings->twitter }}" placeholder="Twitter">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="instagram" class="form-label">İnstagram*</label>
                                                    <input type="text" id="instagram" name="instagram"
                                                           class="form-control" value="{{ $settings->instagram }}"
                                                           placeholder="İnstagram">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="pinterest" class="form-label">Pinterest*</label>
                                                    <input type="text" id="pinterest" name="pinterest"
                                                           class="form-control" value="{{ $settings->pinterest }}"
                                                           placeholder="Pinterest">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="youtube" class="form-label">Youtube*</label>
                                                    <input type="text" id="youtube" name="youtube" class="form-control"
                                                           value="{{ $settings->youtube }}" placeholder="Youtube">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-about-us" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="vision" class="form-label">Vizyon*</label>
                                                    <textarea type="text" id="vision" name="vision"
                                                              class="form-control" placeholder="Vizyon"
                                                              rows="6">{{ $settings->vision }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="mission" class="form-label">Misyon*</label>
                                                    <textarea type="text" id="mission" name="mission"
                                                              class="form-control" placeholder="Misyon"
                                                              rows="6">{{ $settings->mission }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="experience_year" class="form-label">Tecrübe (Yıl)*</label>
                                                    <input type="text" id="experience_year" name="experience_year"
                                                           class="form-control" value="{{ $settings->experience_year }}"
                                                           placeholder="Tecrübe (Yıl)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="experience_title" class="form-label">Tecrübe (Başlık)*</label>
                                                    <input type="text" id="experience_title" name="experience_title"
                                                           class="form-control" value="{{ $settings->experience_title }}"
                                                           placeholder="Tecrübe (Başlık)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="experience_small_title" class="form-label">Tecrübe (Küçük Başlık)*</label>
                                                    <input type="text" id="experience_small_title" name="experience_small_title"
                                                           class="form-control" value="{{ $settings->experience_small_title }}"
                                                           placeholder="Tecrübe (Küçük Başlık)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-others" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="privacy_policy" class="form-label">Gizlilik Politikası*</label>
                                                    <textarea type="text" id="privacy_policy" name="privacy_policy"
                                                              class="form-control" placeholder="Gizlilik Politikası"
                                                              rows="6">{{ $settings->privacy_policy }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="cookie_policy" class="form-label">Çerez Politikası*</label>
                                                    <textarea type="text" id="cookie_policy" name="cookie_policy"
                                                              class="form-control" placeholder="Çerez Politikası"
                                                              rows="6">{{ $settings->cookie_policy }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="analytics" class="form-label">Analytics*</label>
                                                    <textarea type="text" id="analytics" name="analytics"
                                                              class="form-control" placeholder="Analytics"
                                                              rows="6">{{ $settings->analytics }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md">Kaydet</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4">
                    <div class="col-md-12">
                        <form method="POST" action="{{ url("backend.admin.settings.updateImage") }}"
                              enctype="multipart/form-data" id="settingsImageForm">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">Logo</label>
                                                <img src="{{ $settings->logo }}"
                                                     style="width: 100%; height: 100px;">
                                                <input type="file" id="logo" name="logo" class="form-control mt-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="favicon" class="form-label">Favicon</label>
                                                <img src="{{ $settings->favicon }}"
                                                     style="width: 100%; height: 150px;">
                                                <input type="file" id="favicon" name="favicon"
                                                       class="form-control mt-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-primary w-md" id="btn-updateImage">Kaydet
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <form action="{{ url("backend.admin.settings.updateRecaptcha") }}" method="POST" id="settingsRecaptchaForm">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Google ReCaptcha</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="sitekey" class="form-label">Sitekey*</label>
                                                <input type="text" id="sitekey" name="sitekey"
                                                       class="form-control"
                                                       placeholder="Sitekey" value="{{ $settings->sitekey }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="secretkey" class="form-label">Secretkey*</label>
                                                <input type="text" id="secretkey" name="secretkey"
                                                       class="form-control"
                                                       placeholder="Secretkey" value="{{ $settings->secretkey }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md" id="btn-recaptcha">Kaydet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;">
        <script src="/public/backend-assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#analytics'));
            ClassicEditor.create(document.querySelector('#privacy_policy'));
            ClassicEditor.create(document.querySelector('#cookie_policy'));
        </script>
    </div>
@endsection

