@extends('layout.screen.common')
@section('title', __('common.operator-board'))
@section('body')
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-lg-1 p-0 mb-4" id="operator-board-left">
                <a href="{{ route('service.operator-board.start',['code' => $meeting_hall->code, 'program_order' => (int)\Route::current()->parameter('program_order') - 1]) }}" >
                <button type="button" class="btn btn-dark w-100 h-100 text-center text-white"><i class="fa-solid fa-chevron-left display-1"></i></button>
                </a>
            </div>
            <div class="col-12 col-lg-10 mb-4 mt-4 card text-bg-dark" id="operator-board-main">
                <div class="card-header">
                    <h2 class="mt-1 text-center h2">{{__('common.operator-board')}}<small> {{ $meeting_hall->title }}</small></h2>
                    <hr/>
                </div>
                <div class="card-body p-0 border-dark">
                        <div class="row row-cols-1 row-cols-sm-2 flex-shrink-0 g-2">
                        <div class="col border-end border-color1">
                            <div class="card text-bg-dark p-0 border-dark">
                                <div class="card-header">
                                    <h2 class="m-0 text-center h3">{{ $program->title }}</h2>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @isset($program)
                                    <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-hotel mx-1"></span> {{ __('common.hall') }}:</b> {{ $meeting_hall->title }}</li>
                                    <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}:</b> {{ $program->start_at }}</li>
                                    <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}:</b> {{ $program->finish_at }}</li>
                                    <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-person-military-pointing mx-1"></span> {{ __('common.type') }}:</b> {{ __('common.'.$program->type) }}</li>
                                    <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}:</b>
                                        @if($program->status)
                                            {{ __('common.active') }}
                                        @else
                                            {{ __('common.passive') }}
                                        @endif
                                    </li>
                                    @endisset
                                </ul>
                            </div>
                        </div>
                        <div class="col card text-bg-dark p-0 border-dark">
                            <div class="card-header">
                                <h2 class="m-0 text-center h3"><div id="time"></div></h2>
                            </div>
                            @isset($timer_screen)
                            <div class="card-body p-0 m-2">
                                <div class="container-fluid p-4">
                                        <div class="row-col-1 justify-content-start align-items-center">
                                            <div class="col-lg-6 form-group mb-3">
                                                <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $timer_screen->code, 'action' => 'edit']) }}" name="create-form-{{ $timer_screen->id }}" id="create-form-{{ $timer_screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                                    <div class="container-fluid">
                                                        @csrf
                                                        <x-input.hidden name="time" :value="0" />
                                                        <input type="number" name="time" class="form-control @error('time')is-invalid @enderror" id="c-time" placeholder="{{ __('common.time') }}" min="0" autocomplete="false" />
                                                        @error('time')
                                                        <div class="invalid-feedback d-block">
                                                            <i class="fa-regular fa-triangle-exclamation"></i> {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <button type="submit" class="btn btn-success w-100 mt-2" id="create-form-submit-{{ $timer_screen->id }}">{{ __('common.reset') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-6 form-group mx-3">
                                                <div class="row row-cols-1 row-cols-md-1 row-cols-sm-1 row-cols-xl-1 justify-content-center mt-2">
                                                    <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                        <form method="POST" action="{{ route('service.screen.timer.index', ['meeting_hall_screen_code' => $timer_screen->code]) }}" name="index-{{ $timer_screen->id }}" id="index-{{ $timer_screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                                            @csrf
                                                            <x-input.hidden name="time" :value="null" />
                                                            <button type="submit" class="btn btn-primary w-100" id="create-form-submit-{{ $timer_screen->id }}"><span class="fa-regular fa-presentation-screen"></span></button>
                                                        </form>
                                                        <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $timer_screen->code, 'action' => 'start']) }}" name="start-form-{{ $timer_screen->id }}" id="start-form-{{ $timer_screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                                            @csrf
                                                            <x-input.hidden name="time" :value="null" />
                                                            <button type="submit" class="btn btn-success w-100" id="create-form-submit-{{ $timer_screen->id }}"><span class="fa-regular fa-play"></span></button>
                                                        </form>
                                                        <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $timer_screen->code, 'action' => 'stop']) }}" name="stop-form-{{ $timer_screen->id }}" id="stop-form-{{ $timer_screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                                            @csrf
                                                            <x-input.hidden name="time" :value="null" />
                                                            <button type="submit" class="btn btn-danger w-100" id="create-form-submit-{{ $timer_screen->id }}"><span class="fa-regular fa-stop"></span></button>
                                                        </form>
                                                        <form method="POST" action="{{ route('service.screen-board.timer-screen', ['code' => $timer_screen->code, 'action' => 'reset']) }}" name="stop-form-{{ $timer_screen->id }}" id="stop-form-{{ $timer_screen->id }}" enctype="multipart/form-data" autocomplete="nope">
                                                            @csrf
                                                            <x-input.hidden name="time" :value="null" />
                                                            <button type="submit" class="btn btn-warning w-100" id="create-form-submit-{{ $timer_screen->id }}"><span class="fa-regular fa-power-off"></span></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
                    @isset($sessions)
                        <div class="row row-cols-1">
                            <div class="col card text-bg-dark p-0 border-dark">
                                <hr class="border-light mb-0"/>
                                <div class="card-header border-bottom border-light border-1 border-opacity-50">
                                    <h1 class="m-0 text-center">{{ __('common.sessions') }}</h1>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-striped table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col"><span class="fa-regular fa-circle-play mx-1"></span> {{ __('common.is-started') }}</th>
                                                <th scope="col"><span class="fa-regular fa-person-chalkboard mx-1"></span> {{ __('common.speaker') }}</th>
                                                <th scope="col"><span class="fa-regular fa-folder-open mx-1"></span> {{ __('common.document') }}</th>
                                                <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                                <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}</th>
                                                <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}</th>
                                                <th scope="col"><span class="fa-regular fa-block-question mx-1"></span> {{ __('common.questions') }}</th>
                                                <th scope="col"><span class="fa-regular fa-circle-play mx-1"></span> {{ __('common.is-questions-started') }}</th>
                                                <th scope="col"><span class="fa-regular fa-circle-1 mx-1"></span> {{ __('common.question-limit') }}</th>
                                                <th scope="col"><span class="fa-regular fa-tablet mx-1"></span> {{ __('common.keypads') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sessions as $session)
                                                <tr>
                                                    <td>
                                                        <a href =""  title="{{ __('common.start-stop') }}" data-bs-toggle="modal" data-bs-target="#start-session-confirmation-modal" data-route="{{ route('portal.meeting.hall.program.session.start-stop', ['meeting' => $program->hall->meeting_id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $session->id]) }}" data-record="{{ $session->title }}" data-start-stop="{{ $session->on_air }} " data-bs-title="{{ __('common.start-stop') }}">
                                                                @if($session->on_air)
                                                                    <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                                @else
                                                                    <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                                @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($session->speaker_id)
                                                            {{ $session->speaker->full_name }}
                                                        @else
                                                            <i class="text-info">{{ __('common.unspecified') }}</i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($session->document_id && $session->document)
                                                            <a href="{{ route('portal.meeting.document.download', ['meeting' => $program->hall->meeting_id, 'document' => $session->document->file_name]) }}" class="btn btn-sm btn-info w-100" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.view') }}">
                                                                <span class="fa-regular fa-file-arrow-down"></span> {{ $session->document->title }}
                                                            </a>
                                                        @else
                                                            <i class="text-info">{{ __('common.unspecified') }}</i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $session->title }}</td>
                                                    <td>{{ $session->start_at }}</td>
                                                    <td>{{ $session->finish_at }}</td>
                                                    <td>
                                                        @if($session->questions_allowed)
                                                            <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                        @else
                                                            <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($session->questions_allowed)
                                                            <a href="{{ route('portal.meeting.hall.program.session.start-stop-questions', ['meeting' => $program->hall->meeting_id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $session->id]) }}" title="{{ __('common.start-stop-questions') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.start-stop-questions') }}">
                                                            @if($session->is_questions_started)
                                                                <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                            @else
                                                                <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                            @endif
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($session->questions_allowed)
                                                            <a href ="{{ route('portal.meeting.hall.program.session.edit-question-limit', ['meeting' => $program->hall->meeting_id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $session->id, 'increment' => -1]) }}"  title="{{ __('common.decrement') }}" >
                                                                <i style="color:red" class="fa-regular fa-square-minus fa-lg"></i>
                                                            </a>
                                                            {{ $session->questions_limit }}
                                                            <a href ="{{ route('portal.meeting.hall.program.session.edit-question-limit', ['meeting' => $program->hall->meeting_id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $session->id, 'increment' => 1]) }}"  title="{{ __('common.increment') }}">
                                                                <i style="color:green" class="fa-regular fa-square-plus fa-lg"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.keypads') }}">
                                                                <button class="btn btn-warning btn-sm" title="{{ __('common.keypads') }}" data-bs-toggle="modal" data-bs-target="#session-keypads-modal-{{$session->id}}" >
                                                                    <span class="fa-regular fa-tablet"></span>
                                                                </button>
                                                            </div>
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
                        @foreach($sessions as $session)
                            <div class="modal fade" id="session-keypads-modal-{{$session->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="#{{$session->id}}-session-keypads-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="{{$session->id}}-session-keypads-modal-label">{{ __('common.keypads') }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-striped table-hover">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.on-vote') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($session->keypads as $keypad)
                                                        <tr>
                                                            <td>{{ $keypad->sort_order }}</td>
                                                            <td>{{ $keypad->keypad }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                                    @if($session->on_air)
                                                                    <a href =""  title="{{ __('common.start-stop-voting') }}" data-bs-toggle="modal" data-bs-target="#start-keypad-confirmation-modal" data-route="{{ route('portal.meeting.hall.program.session.keypad.start-stop-voting',['meeting'=>$session->program->hall->meeting_id, 'keypad'=> $keypad->id,'session'=> $session->id,'program'=>$session->program_id, 'hall'=>$session->program->hall_id]) }}" data-record="{{ $keypad->keypad }}" data-start-stop="{{ $keypad->on_vote }}">
                                                                        @if($keypad->on_vote)
                                                                            <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                                        @else
                                                                            <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                                        @endif
                                                                    </a>
                                                                    @else
                                                                        <i class="text-info">{{ __('common.first-you-should-start-session') }}</i>
                                                                    @endif
                                                                    @if($keypad->on_vote)
                                                                    <a href =""  title="{{ __('common.resend-voting') }}" data-bs-toggle="modal" data-bs-target="#start-keypad-confirmation-modal" data-route="{{ route('portal.meeting.hall.program.session.keypad.resend-voting',['meeting'=>$session->program->hall->meeting_id, 'keypad'=> $keypad->id,'session'=> $session->id,'program'=>$session->program_id, 'hall'=>$session->program->hall_id]) }}" data-record="{{ $keypad->keypad }}" data-start-stop="{{ $keypad->on_vote }}">
                                                                        <i style="color:red" class="fa-regular fa-recycle fa-xg"></i>
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
                            </div>
                            <div class="modal fade" id="start-keypad-confirmation-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="#start-keypad-confirmation-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-dark">
                                        <form method="GET" action="" name="start-keypad-confirmation-form" id="start-keypad-confirmation-form" autocomplete="nope">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="start-keypad-confirmation-modal-label">{{ __('common.confirmation') }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><p id="start-keypad-start-stop-record"></p><strong id="start-keypad-confirmation-record" class="text-danger"></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                                                    <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.no') }}</button>
                                                    <button type="submit" class="btn btn-success w-75" id="start-keypad-confirmation-form-submit">{{ __('common.confirmation') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script type="module">
                                const confirmationFormSubmit = document.getElementById('start-keypad-confirmation-form-submit');
                                const confirmationModal = document.getElementById('start-keypad-confirmation-modal');
                                var waitForSeconds, countdown;
                                confirmationModal.addEventListener('show.bs.modal', event => {
                                    const button = event.relatedTarget;
                                    if(button) {
                                        confirmationFormSubmit.disabled = true;
                                        waitForSeconds = 1;
                                        clearInterval(countdown);
                                        document.getElementById('start-keypad-confirmation-form').action = button.getAttribute('data-route');
                                        confirmationModal.querySelector('#start-keypad-confirmation-record').textContent = button.getAttribute('data-record');
                                        if(button.getAttribute('data-start-stop') == 0)
                                            confirmationModal.querySelector('#start-keypad-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop-voting-other-keypads-and-start-voting') }}';
                                        else
                                            confirmationModal.querySelector('#start-keypad-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop-voting') }}';
                                        countdown = setInterval(function() {
                                            confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (--waitForSeconds) + ')';
                                            if (waitForSeconds <= 0) {
                                                confirmationFormSubmit.innerHTML = '{{ __('common.yes') }}';
                                                confirmationFormSubmit.disabled = false;
                                            }
                                        }, 1000);
                                    }
                                    confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (waitForSeconds) + ')';
                                });
                                confirmationFormSubmit.addEventListener('click', function() {
                                    confirmationFormSubmit.disabled = true;
                                    confirmationFormSubmit.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> {{ __('common.loading') }}';
                                    document.getElementById('start-keypad-confirmation-form').submit();
                                });
                            </script>
                        @endforeach
                        <div class="modal fade" id="start-session-confirmation-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="#start-session-confirmation-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <form method="GET" action="" name="start-session-confirmation-form" id="start-session-confirmation-form" autocomplete="nope">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="start-session-confirmation-modal-label">{{ __('common.confirmation') }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><p id="start-session-start-stop-record"></p><strong id="start-session-confirmation-record" class="text-danger"></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                                                <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.no') }}</button>
                                                <button type="submit" class="btn btn-success w-75" id="start-session-confirmation-form-submit">{{ __('common.confirmation') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script type="module">
                            const confirmationFormSubmit = document.getElementById('start-session-confirmation-form-submit');
                            const confirmationModal = document.getElementById('start-session-confirmation-modal');
                            var waitForSeconds, countdown;
                            confirmationModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                if(button) {
                                    confirmationFormSubmit.disabled = true;
                                    waitForSeconds = 1;
                                    clearInterval(countdown);
                                    document.getElementById('start-session-confirmation-form').action = button.getAttribute('data-route');
                                    confirmationModal.querySelector('#start-session-confirmation-record').textContent = button.getAttribute('data-record');
                                    if(button.getAttribute('data-start-stop') == 0)
                                        confirmationModal.querySelector('#start-session-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop-other-sessions-and-start') }}';
                                    else
                                        confirmationModal.querySelector('#start-session-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop') }}';
                                    countdown = setInterval(function() {
                                        confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (--waitForSeconds) + ')';
                                        if (waitForSeconds <= 0) {
                                            confirmationFormSubmit.innerHTML = '{{ __('common.yes') }}';
                                            confirmationFormSubmit.disabled = false;
                                        }
                                    }, 1000);
                                }
                                confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (waitForSeconds) + ')';
                            });
                            confirmationFormSubmit.addEventListener('click', function() {
                                confirmationFormSubmit.disabled = true;
                                confirmationFormSubmit.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> {{ __('common.loading') }}';
                                document.getElementById('start-session-confirmation-form').submit();
                            });
                        </script>
                    @endisset
                    @isset($debates)
                        <div class="row row-cols-1">
                            <div class="col card text-bg-dark p-0">
                                <div class="card-header">
                                    <h1 class="m-0 text-center">{{ __('common.debates') }}</h1>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-striped table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                                <th scope="col"><span class="fa-regular fa-comment-dots mx-1"></span> {{ __('common.description') }}</th>
                                                <th scope="col"><span class="fa-regular fa-box-ballot mx-1"></span> {{ __('common.on-vote') }}</th>
                                                <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.voting-started-at') }}</th>
                                                <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.voting-finished-at') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($debates as $debate)
                                                <tr>
                                                    <td>{{ $debate->title }}</td>
                                                    <td>{{ $debate->description }}</td>
                                                    <td>
                                                        <a href =""  title="{{ __('common.start-stop') }}" data-bs-toggle="modal" data-bs-target="#start-debate-confirmation-modal" data-route="{{ route('portal.meeting.hall.program.debate.start-stop-voting', ['meeting' => $meeting_hall->meeting_id, 'hall' => $meeting_hall->id, 'program' => $program->id, 'debate' => $debate->id]) }}" data-record="{{ $debate->title }}" data-start-stop="{{ $debate->on_vote }}">
                                                            @if($debate->on_vote)
                                                            <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                            @else
                                                            <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{ $debate->voting_started_at }}</td>
                                                    <td>{{ $debate->voting_finished_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="start-debate-confirmation-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="#start-debate-confirmation-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <form method="GET" action="" name="start-debate-confirmation-form" id="start-debate-confirmation-form" autocomplete="nope">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="start-debate-confirmation-modal-label">{{ __('common.confirmation') }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><p id="start-debate-start-stop-record"></p><strong id="start-debate-confirmation-record" class="text-danger"></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                                                <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.no') }}</button>
                                                <button type="submit" class="btn btn-success w-75" id="start-debate-confirmation-form-submit">{{ __('common.confirmation') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script type="module">
                            const confirmationFormSubmit = document.getElementById('start-debate-confirmation-form-submit');
                            const confirmationModal = document.getElementById('start-debate-confirmation-modal');
                            var waitForSeconds, countdown;
                            confirmationModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                if(button) {
                                    confirmationFormSubmit.disabled = true;
                                    waitForSeconds = 1;
                                    clearInterval(countdown);
                                    document.getElementById('start-debate-confirmation-form').action = button.getAttribute('data-route');
                                    confirmationModal.querySelector('#start-debate-confirmation-record').textContent = button.getAttribute('data-record');
                                    if(button.getAttribute('data-start-stop') == 0)
                                        confirmationModal.querySelector('#start-debate-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop-voting-other-debates-and-start-voting') }}';
                                    else
                                        confirmationModal.querySelector('#start-debate-start-stop-record').textContent = '{{ __('common.are-you-sure-you-want-to-stop-voting') }}';
                                    countdown = setInterval(function() {
                                        confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (--waitForSeconds) + ')';
                                        if (waitForSeconds <= 0) {
                                            confirmationFormSubmit.innerHTML = '{{ __('common.yes') }}';
                                            confirmationFormSubmit.disabled = false;
                                        }
                                    }, 1000);
                                }
                                confirmationFormSubmit.innerHTML = '{{ __('common.yes') }} (' + (waitForSeconds) + ')';
                            });
                            confirmationFormSubmit.addEventListener('click', function() {
                                confirmationFormSubmit.disabled = true;
                                confirmationFormSubmit.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> {{ __('common.loading') }}';
                                document.getElementById('start-debate-confirmation-form').submit();
                            });
                        </script>
                    @endisset
                </div>
            </div>

            <div class="col-12 col-lg-1 p-0 mb-4" id="operator-board-right">
                <a href="{{ route('service.operator-board.start',['code' => $meeting_hall->code, 'program_order' => (int)\Route::current()->parameter('program_order') + 1]) }}" >
                <button title="{{ __('common.operator-board') }}" type="button" class="btn btn-dark w-100 h-100 text-center text-white"><i class="fa-solid fa-chevron-right display-1"></i></button>
                </a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showTime() {
            var date = new Date()
            document.getElementById('time').innerHTML = 'Time: ' + date.toLocaleTimeString('en-US');
        }
        setInterval(showTime, 1000);
    </script>
@endsection
