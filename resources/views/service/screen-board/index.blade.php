@extends('layout.screen.common')
@section('title', __('common.screen-board'))
@section('body')
<body class="d-flex bg-dark flex-column h-100">
<div class="container-fluid h-100">
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-display fa-fade"></span> <small>"{{ $hall->title }}"</small> {{ __('common.screens') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                        <th scope="col"><span class="fa-regular fa-person-military-pointing mx-1"></span> {{ __('common.type') }}</th>
                        <th scope="col"><span class="fa-regular fa-tv mx-1"></span> {{ __('common.content') }}</th>
                        <th scope="col" class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($screens as $screen)
                        <tr>
                            <td>{{ $screen->title }}</td>
                            <td>{{ __('common.'.$screen->type) }}</td>
                            <td>
                                @if($screen->type == 'speaker')
                                    <form method="POST" action="{{ route('service.screen-board.speaker-screen', ['code' => $screen->code]) }}" name="create-form-{{ $screen->id }}" id="create-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-start align-items-center">
                                                @csrf
                                                <div class="col form-group mb-3">
                                                <x-input.select method="c" name="speaker_id" title="speaker" :options="$participants" option_value="id" option_name="full_name" icon="person-chalkboard" />
                                                </div>
                                                <div class="col form-group mb-3">
                                                <button type="submit" class="btn btn-success w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.edit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($screen->type == 'chair')
                                    <form method="POST" action="{{ route('service.screen-board.chair-screen', ['code' => $screen->code]) }}" name="create-form-{{ $screen->id }}" id="create-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-start align-items-center">
                                                @csrf
                                                <div class="col form-group mb-3">
                                                <x-input.select method="c" name="chair_id" title="chair" :options="$participants" option_value="id" option_name="full_name" icon="person-chalkboard" />
                                                </div>
                                                <div class="col form-group mb-3">
                                                <button type="submit" class="btn btn-success w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.edit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($screen->type == 'keypad')
                                    <form method="POST" action="{{ route('service.screen-board.keypad-screen', ['code' => $screen->code]) }}" name="create-form-{{ $screen->id }}" id="create-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-start align-items-center">
                                                @csrf
                                                <div class="col form-group mb-3">
                                                <x-input.select method="c" name="keypad_id" title="keypad" :options="$keypads" option_value="id" option_name="keypad" icon="tablet" />
                                                </div>
                                                <div class="col form-group mb-3">
                                                <button type="submit" class="btn btn-success w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.edit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($screen->type == 'timer')
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-start align-items-center">
                                    <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $screen->code, 'action' => 'restart']) }}" name="create-form-{{ $screen->id }}" id="create-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-start align-items-center">
                                                @csrf
                                                <x-input.hidden name="time" :value="0" />
                                                <div class="col form-group mb-3">
                                                    <x-input.number name="time" title="time" icon="clock"/>
                                                </div>
                                                <div class="col form-group mb-3">
                                                <button type="submit" class="btn btn-success w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.edit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $screen->code, 'action' => 'start']) }}" name="start-form-{{ $screen->id }}" id="start-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="col form-group mb-3">
                                                @csrf
                                                <x-input.hidden name="time" :value="null" />
                                            <button type="submit" class="btn btn-success w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.start') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $screen->code, 'action' => 'stop']) }}" name="stop-form-{{ $screen->id }}" id="stop-form-{{ $screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                        <div class="container-fluid">
                                            <div class="col form-group mb-3">
                                                @csrf
                                                <x-input.hidden name="time" :value="null" />
                                                <button type="submit" class="btn btn-danger w-75" id="create-form-submit-{{ $screen->id }}">{{ __('common.stop') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                    @if($screen->type == 'speaker')
                                        <a class="btn btn-outline-success btn-sm" href="{{ route('service.screen.speaker.index', ['meeting_hall_screen_code' => $screen->code]) }}" title="{{ __('common.screen') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.screen') }}" target="_blank">
                                            <span class="fa-regular fa-tv"></span>
                                        </a>
                                    @elseif($screen->type == 'chair')
                                        <a class="btn btn-outline-success btn-sm" href="{{ route('service.screen.chair.index', ['meeting_hall_screen_code' => $screen->code]) }}" title="{{ __('common.screen') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.screen') }}" target="_blank">
                                            <span class="fa-regular fa-tv"></span>
                                        </a>
                                    @elseif($screen->type == 'questions')
                                        <a class="btn btn-outline-success btn-sm" href="{{ route('service.screen.questions.index', ['meeting_hall_screen_code' => $screen->code]) }}" title="{{ __('common.questions') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.questions') }}" target="_blank">
                                            <span class="fa-regular fa-tv"></span>
                                        </a>
                                    @elseif($screen->type == 'keypad')
                                        <a class="btn btn-outline-success btn-sm" href="{{ route('service.screen.keypad.index', ['meeting_hall_screen_code' => $screen->code]) }}" title="{{ __('common.keypad') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.keypad') }}" target="_blank">
                                            <span class="fa-regular fa-tv"></span>
                                        </a>
                                    @elseif($screen->type == 'timer')
                                        <a class="btn btn-outline-success btn-sm" href="{{ route('service.screen.timer.index', ['meeting_hall_screen_code' => $screen->code]) }}" title="{{ __('common.timer') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.timer') }}" target="_blank">
                                            <span class="fa-regular fa-tv"></span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
@endsection