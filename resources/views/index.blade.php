<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>Gourmet</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2561/2561550.png">

<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/toastr.css') }}" />

<body>
    <div class="form-card">
        @include("form")
    </div>
</body>

<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="{{ URL::asset('js/toastr.min.js') }}"></script>