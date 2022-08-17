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
                    <form method="POST" action="{{ url("frontend.changePassword.resetPasswordSendMail") }}" class="form" id="emailScreenForm">
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="email" type="text" name="email" placeholder="Email Adresi">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn"><span>Gönder<i class="ti-arrow-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
