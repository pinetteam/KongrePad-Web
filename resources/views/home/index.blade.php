<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="apple-itunes-app" content="app-id=6463897045, app-argument=https://apps.apple.com/tr/app/kongrepad/id6463897045">
    <title>Home | {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])
</head>
<header class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" id="kp-header">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 overflow-hidden text-center" href="{{ route("auth.login.index") }}">
        {{ config('app.name') }}
    </a>
</header>
<body class="d-flex flex-column h-100 bg-dark">
    <div id="kp-loading" class="d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">{{ __('common.loading') }}</span>
        </div>
    </div>
    <div class="container" id="kp-home">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-2 gy-3 py-3">
            <div class="col">
                <div class="card text-bg-dark border-0">
                    <div class="card-body text-center">
                        <h1 class="h3 border-bottom border-dark-subtle">KongrePad'i indirin</h1>
                        <div class="row">
                            <div class="col">
                                <a href="https://apps.apple.com/tr/app/kongrepad/id6463897045?l=tr" target="_blank" title="KongrePad AppStore">
                                    <img src="{{ asset('images/app-store-download.svg') }}" class="img-fluid" alt="KongrePad AppStore" />
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://app.kongrepad.com/kongrepad.apk" target="_blank" title="KongrePad PlayStore">
                                    <img src="{{ asset('images/play-store-download.svg') }}" class="img-fluid" alt="KongrePad PlayStore" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-dark border-0">
                    <div class="card-body">
                        <img src="{{ asset('images/home-screenshot-01.png') }}" class="img-fluid rounded shadow" alt="KongrePad 01" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="bg-dark text-light col-12 px-md-4 ms-sm-auto px-md-4 shadow" id="kp-footer">
    Copyright © 2017-{{ date('Y') }} {{ config('app.name') }}
</footer>
</html>
