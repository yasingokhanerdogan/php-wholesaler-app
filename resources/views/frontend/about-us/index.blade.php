@extends("frontend.layouts.master")
@section("title", "Hakkımızda | $settings->company_name")
@section("content")
    <section class="about pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">HAKKIMIZDA</h6>
                    <h4 class="title">VİZYONUMUZ</h4>
                    <p>{{ $settings["vision"] }}</p>
                </div>
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">HAKKIMIZDA</h6>
                    <h4 class="title">MİSYONUMUZ</h4>
                    <p>{{ $settings["mission"] }}</p>
                </div>
                <div class="col-md-12">
                    <div class="yearimg">
                        <div class="numb">{{ $settings["experience_year"] }}</div>
                    </div>
                    <div class="year">
                        <h6 class="small-title">{{ $settings["experience_small_title"] }}</h6>
                        <h4 class="title">{{ $settings["experience_title"] }}</h4>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection



