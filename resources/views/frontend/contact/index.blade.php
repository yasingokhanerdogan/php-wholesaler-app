@extends("frontend.layouts.master")
@section("title", "İletişim | $settings->company_name")
@section("content")
    <section class="contact pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">İletişime Geçin</h6>
                    <h4 class="title">İletişim Formu</h4>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <div class="con">
                            <h5>{{ $settings["city"] }}</h5>
                            <p><i class="ti-home"
                                  style="font-size: 15px; color: #c5a47e;"></i> {{ $settings["address"] }}</p>
                            <p><i class="ti-mobile"
                                  style="font-size: 15px; color: #c5a47e;"></i> {{ $settings["phone"] }}</p>
                            <p><i class="ti-envelope"
                                  style="font-size: 15px; color: #c5a47e;"></i> {{ $settings["email"] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="form" method="POST" action="{{url("frontend.contact.sendMail")}}"
                          id="contactSendMailForm">
                        <div id="messages"></div>
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="name" type="text" name="name" placeholder="Ad Soyad">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="email" type="text" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="subject" type="text" name="subject" placeholder="Konu">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea id="message" name="message" placeholder="Mesaj" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mb-4">
                                    <div id="g-recaptcha" class="g-recaptcha" data-sitekey="{{ $settings->sitekey }}"></div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn"><span>Gönder <i class="ti-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
