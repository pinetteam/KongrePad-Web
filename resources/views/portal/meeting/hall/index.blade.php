@extends('layout.portal.common')
@section('title', $meeting->title . ' | ' . __('common.halls'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none text-white">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('portal.meeting.show', $meeting->id) }}" class="text-decoration-none text-white">{{ $meeting->title }}</a></li>
    <li class="breadcrumb-item active text-white text-decoration-underline" aria-current="page">{{ __('common.halls') }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-hotel fa-fade"></span> <small>"{{ $meeting->title }}"</small> {{ __('common.halls') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <caption class="text-end me-3">
                        {{ $halls->links() }}
                    </caption>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.show-on-session') }}</th>
                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.show-on-ask-question') }}</th>
                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.show-on-view-program') }}</th>
                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.show-on-send-mail') }}</th>
                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                            <th scope="col" class="text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($halls as $hall)
                            <tr>
                                <td>{{ $hall->title }}</td>
                                <td >
                                    @if($hall->show_on_session)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td >
                                    @if($hall->show_on_ask_question)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td >
                                    @if($hall->show_on_view_program)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td >
                                    @if($hall->show_on_send_mail)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td >
                                    @if($hall->status)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                        <a class="btn btn-info btn-sm" href="{{ route('service.operator-board.start', ['code' => $hall->code, 'program_order' => 0]) }}" title="{{ __('common.operator-board') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.operator-board') }}">
                                            <span class="fa-regular fa-rectangles-mixed"></span>
                                        </a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('service.screen-board.start', ['code' => $hall->code]) }}" title="{{ __('common.screen-board') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.screen-board') }}">
                                            <span class="fa-regular fa-screen-users"></span>
                                        </a>
                                        <a class="btn btn-success btn-sm" href="{{ route('service.question-board.start', ['code' => $hall->code]) }}" title="{{ __('common.question-board') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.question-board') }}">
                                            <span class="fa-regular fa-question"></span>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('portal.meeting.hall.show', ['meeting' => $meeting->id, 'hall' => $hall->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                            <span class="fa-regular fa-eye"></span>
                                        </a>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                            <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#hall-edit-modal" data-route="{{ route('portal.meeting.hall.update', ['meeting' => $meeting->id, 'hall' => $hall->id]) }}" data-resource="{{ route('portal.meeting.hall.edit', ['meeting' => $meeting->id, 'hall' => $hall->id]) }}" data-id="{{ $hall->id }}">
                                                <span class="fa-regular fa-pen-to-square"></span>
                                            </button>
                                        </div>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                            <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#hall-delete-modal" data-route="{{ route('portal.meeting.hall.destroy', ['meeting' => $meeting->id, 'hall' => $hall->id]) }}" data-record="{{ $hall->title }}">
                                                <span class="fa-regular fa-trash"></span>
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
        <div class="card-footer d-flex justify-content-center">
            <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#hall-create-modal" data-route="{{ route('portal.meeting.hall.store', ['meeting' => $meeting->id]) }}">
                <i class="fa-solid fa-plus"></i> {{ __('common.create-new-hall') }}
            </button>
        </div>
    </div>
    <x-crud.form.common.create name="hall" >
        @section('hall-create-form')
            <x-input.hidden method="c" name="meeting_id" :value="$meeting->id" />
            <x-input.text method="c" name="title" title="title" icon="input-text" />
            <x-input.radio method="c" name="show_on_session" title="show-on-session" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="c" name="show_on_ask_question" title="show-on-ask-question" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="c" name="show_on_view_program" title="show-on-view-program" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="c" name="show_on_send_mail" title="show-on-send-mail" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
        @endsection
    </x-crud.form.common.create>
    <x-crud.form.common.delete name="hall" />
    <x-crud.form.common.edit name="hall" >
        @section('hall-edit-form')
            <x-input.hidden method="e" name="meeting_id" :value="$meeting->id" />
            <x-input.text method="e" name="title" title="title" icon="input-text" />
            <x-input.radio method="e" name="show_on_session" title="show-on-session" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="e" name="show_on_ask_question" title="show-on-ask-question" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="e" name="show_on_view_program" title="show-on-view-program" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="e" name="show_on_send_mail" title="show-on-send-mail" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            <x-input.radio method="e" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
        @endsection
    </x-crud.form.common.edit>
@endsection
