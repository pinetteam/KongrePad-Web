<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{__('common.current-chair').' show.blade.php'.$chair_index}} | {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])
</head>
<body class="d-flex flex-column h-100">
<header class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" id="kp-header">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 overflow-hidden text-center"
       href="{{ route("portal.dashboard.index") }}">
        @if(Auth()->check() && isset(Auth()->user()->customer->title))
            {{ Auth()->user()->customer->title }}
        @else
            {{ config('app.name') }}
        @endif
    </a>
</header>
<main class="col-md-12 col-lg-12 ms-sm-auto px-md-4 flex-grow-1 d-flex align-items-stretch" id="kp-main">
    <div class="card text-center text-bg-dark w-100">
        <div class="card-body justify-content-center d-flex align-items-center">
            @isset($chair)
                <ul>
                    <li class="list-group-item"><h1 class="display-1">{{ $chair->chair->full_name }}</h1></li>
                    <li class="list-group-item"><h1>{{ __('common.chair') }}</h1></li>
                </ul>
            @endisset
        </div>
    </div>
</main>
