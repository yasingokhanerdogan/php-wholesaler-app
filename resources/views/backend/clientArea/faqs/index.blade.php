@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Sıkça Sorulan Sorular | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Sıkça Sorulan Sorular</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Sıkça Sorulan Sorular</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

           <div class="row">
               <div class="col-xl-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="accordion" id="accordion">
                               @php $faqRank = 1; @endphp
                               @foreach($faqs as $faq)
                                   <div class="accordion-item">
                                       <h2 class="accordion-header" id="heading-{{ $faqRank }}">
                                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faqRank }}" aria-expanded="false" aria-controls="collapse-{{ $faqRank }}">
                                               {{ $faqRank . ". " . $faq->question }}
                                           </button>
                                       </h2>
                                       <div id="collapse-{{ $faqRank }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $faqRank }}" data-bs-parent="#accordion" style="">
                                           <div class="accordion-body">
                                               {!! $faq->answer !!}
                                           </div>
                                       </div>
                                   </div>

                                   @php $faqRank++; @endphp
                               @endforeach
                           </div>


                       </div>
                   </div>
               </div>
           </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
