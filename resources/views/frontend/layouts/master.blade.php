<!DOCTYPE html>
<html lang="tr">
<head>
    @include("frontend.layouts.dependencies.head")

    <script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>

    {!! strip_tags($settings->analytics) !!}
</head>

<body>
<!-- Loader -->
<div id="loader">
    <div class="loading">
        <div></div>
    </div>
</div>

@include("frontend.layouts.includes.sidebar")

<!-- Content -->
<div class="togo-side-content">
    <!-- Lines -->
    <div class="content-lines-wrapper">
        <div class="content-lines-inner">
            <div class="content-lines"></div>
        </div>
    </div>

    @yield("content")

    @if($_SERVER["REQUEST_URI"] != url("frontend.home"))
        @include("frontend.layouts.includes.footer")
    @endif

</div>

@include("frontend.layouts.dependencies.foot")
</body>
</html>