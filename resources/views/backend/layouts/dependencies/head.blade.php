<meta charset="utf-8" />
<title>@yield("title")</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="@yield("description", $settings->description)" name="description" />
<meta content="{{ $settings->keywords }}" name="keywords" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">

<base href="{{ baseUrl }}">

<link rel="canonical" href="{{ baseUrl }}">
<link rel="shortcut icon" href="{{ $settings->favicon }}">

<link href="/public/backend-assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="/public/backend-assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css">

<link href="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
<link href="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="/public/backend-assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<link href="/public/backend-assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
<link href="/public/backend-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/public/backend-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/public/backend-assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="/public/backend-assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/backend-assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>

<link href="/public/backend-assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" type="text/css"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>