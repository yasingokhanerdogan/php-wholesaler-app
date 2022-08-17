@extends("frontend.layouts.master")
@section("title", "Şifre Değiştir | $settings->company_name")
@section("content")
    <section class="contact mt-100 pt-100 pb-100">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 mb-20">
                    <h4 class="title">Şifre Değiştir</h4>
                    <h6 class="small-title">Email Adresinize Link Gönderilecek!</h6>
                </div>
            </div>
            <div class="row pb-100">
                <div class="col-md-6 offset-md-3">
                    <form method="POST" action="{{ url("frontend.changePassword.resetPassword") }}" class="form" id="resetPassword">
                        <input id="code" type="hidden" name="code" value="{{ $code }}">
                        <div id="login_error"></div>
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="code" type="text" name="code" placeholder="Doğrulama Kodu" value="{{ $code }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="email" type="text" name="email" placeholder="Email Adresi*" value="{{ $user->email  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="password" type="password" name="password" placeholder="Şifre*">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn"><span>Değiştir<i class="ti-arrow-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
