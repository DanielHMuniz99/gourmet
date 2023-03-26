<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

<body>
    <div class="form-card">
        @include("form")
    </div>
</body>

<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>