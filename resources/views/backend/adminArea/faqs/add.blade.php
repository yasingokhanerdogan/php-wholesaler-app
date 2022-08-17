@php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
@endphp
@extends("backend.layouts.master")
@section("title", "Soru Ekle | $settings->title")
@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Sıkça Sorulan Sorular</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item"><a href="{{ url("backend.admin.faqs") }}">Sıkça Sorulan Sorular</a></li>
                                <li class="breadcrumb-item active">Soru ekle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ url("backend.admin.faq.create") }}" id="createFaqsForm">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="question" class="col-form-label">Soru*</label>
                                        <textarea class="form-control" type="text"
                                               id="question"
                                               name="question"
                                                  placeholder="Soru"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer" class="col-form-label">Cevap*</label>
                                        <textarea class="form-control" type="text"
                                               id="answer"
                                               name="answer"
                                                  placeholder="Cevap"></textarea>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" id="createFaq" class="btn btn-primary w-md">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <script src="/public/backend-assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="/public/backend-assets/js/pages/form-editor.init.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#answer'));
    </script>
@endsection
