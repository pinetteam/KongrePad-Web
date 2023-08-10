@extends('layout.portal.common')
@section('title', __('common.hall').' | '.$hall->title)
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="text-center">
                <span class="fa-duotone fa-hotel fa-fade"></span> <small>"{{ $hall->title }}"</small>
            </h1>
            <div class="table-responsive">
                <table class="table table-dark table-striped-columns table-bordered">
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.meeting-title') }}:</th>
                        <td class="text-start w-25">
                            @if($hall->status)
                                <i style="color:green" class="fa-regular fa-toggle-on"></i>
                            @else
                                <i style="color:red" class="fa-regular fa-toggle-off"></i>
                            @endif
                            {{ $hall->title }}
                        </td>
                        <th scope="row" class="text-end w-25">{{ __('common.hall-program-count') }}:</th>
                        <td class="text-start w-25">{{ $hall->programs->count() }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.created-by') }}:</th>
                        <td class="text-start w-25">{{ $hall->created_by }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.created-at') }}:</th>
                        <td class="text-start w-25">{{ $hall->created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center">{{ __('common.programs') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <caption class="text-end me-3">
                        {{ $programs->links() }}
                    </caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-hotel mx-1"></span> {{ __('common.hall') }}</th>
                        <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort') }}</th>
                        <th scope="col"><span class="fa-regular fa-code-simple mx-1"></span> {{ __('common.code') }}</th>
                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                        <th scope="col"><span class="fa-regular fa-image mx-1"></span> {{ __('common.logo') }}</th>
                        <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}</th>
                        <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}</th>
                        <th scope="col"><span class="fa-regular fa-person-military-pointing mx-1"></span> {{ __('common.type') }}</th>
                        <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                        <th scope="col" class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td>{{ $program->hall->title }}</td>
                            <td>
                                @if($program->sort_order)
                                    {{ $program->sort_order }}
                                @else
                                    <i class="text-info">{{ __('common.unspecified') }}</i>
                                @endif
                            </td>
                            <td>{{ $program->code }}</td>
                            <td>{{ $program->title }}</td>
                            <td>
                                @if($program->logo)
                                    <img src="{{ $program->logo }}" alt="{{ $program->title }}" class="img-thumbnail" style="height:36px;" />
                                @else
                                    <i class="text-info">{{ __('common.unspecified') }}</i>
                                @endif
                            </td>
                            <td>{{ $program->start_at }}</td>
                            <td>{{ $program->finish_at }}</td>
                            <td>{{ __('common.'.$program->type) }}</td>
                            <td>
                                @if($program->status)
                                    <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                @else
                                    <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                    <a class="btn btn-info btn-sm" href="{{ route('portal.meeting.hall.program.show', ['meeting' => $meeting->id, 'hall' => $hall->id, 'program' => $program->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                        <span class="fa-regular fa-eye"></span>
                                    </a>
                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                        <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#default-edit-modal" data-route="{{ route('portal.meeting.hall.program.update', ['meeting' => $meeting->id, 'hall' => $hall->id, 'program' => $program->id]) }}" data-resource="{{ route('portal.meeting.hall.program.edit', ['meeting' => $meeting->id, 'hall' => $hall->id, 'program' => $program->id]) }}" data-id="{{ $program->id }}">
                                            <span class="fa-regular fa-pen-to-square"></span>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                        <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#default-delete-modal" data-route="{{ route('portal.meeting.hall.program.destroy', ['meeting' => $meeting->id, 'hall' => $hall->id, 'program' => $program->id]) }}" data-record="{{ $program->title }}">
                                            <span class="fa-regular fa-trash"></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @if($program->sessions()->count() > 0 )
                            <tr>
                                <td colspan="10">
                                    <div class="card text-bg-dark mt-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-striped table-hover">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col"><span class="fa-regular fa-person-chalkboard mx-1"></span> {{ __('common.speaker') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-presentation-screen mx-1"></span> {{ __('common.document') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-code-simple mx-1"></span> {{ __('common.code') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-block-question mx-1"></span> {{ __('common.questions') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-circle-1 mx-1"></span> {{ __('common.question-limit') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                                                        <th scope="col" class="text-end"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($program->sessions()->get() as $program_session)
                                                        <tr>
                                                            <td>{{ $program_session->speaker->full_name }}</td>
                                                            <td>
                                                                @if($program_session->document_id)
                                                                    <a href="{{ route('portal.meeting.document.download', ['document'=>$program_session->document->file_name, 'meeting'=>$program_session->program->hall->meeting_id]) }}" class="btn btn-sm btn-info w-100" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.view') }}">
                                                                        <span class="fa-regular fa-file-arrow-down"></span> {{ $program_session->document->title }}
                                                                    </a>
                                                                @else
                                                                    <i class="text-info">{{ __('common.unspecified') }}</i>
                                                                @endif
                                                            </td>
                                                            <td>{{ $program_session->sort_order }}</td>
                                                            <td>{{ $program_session->code }}</td>
                                                            <td>{{ $program_session->title }}</td>
                                                            <td>{{ $program_session->start_at }}</td>
                                                            <td>{{ $program_session->finish_at }}</td>
                                                            <td>
                                                                @if($program_session->questions_allowed)
                                                                    <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                                @else
                                                                    <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                                @endif
                                                            </td>
                                                            <td>{{ $program_session->questions_limit }}</td>
                                                            <td>
                                                                @if($program_session->status)
                                                                    <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                                @else
                                                                    <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                                @endif
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                                    <a class="btn btn-info btn-sm" href="{{ route('portal.meeting.hall.program.session.show', ['meeting' => $program->hall->meeting->id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $program_session->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                                                        <span class="fa-regular fa-eye"></span>
                                                                    </a>
                                                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                                                        <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#session-edit-modal" data-route="{{ route('portal.meeting.hall.program.session.update', ['meeting' => $program->hall->meeting->id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $program_session->id]) }}" data-resource="{{ route('portal.meeting.hall.program.session.edit', ['meeting' => $program->hall->meeting->id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $program_session->id]) }}" data-id="{{ $program_session->id }}">
                                                                            <span class="fa-regular fa-pen-to-square"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                                                        <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#session-delete-modal" data-route="{{ route('portal.meeting.hall.program.session.destroy', ['meeting' => $program->hall->meeting->id, 'hall' => $program->hall->id, 'program' => $program->id, 'session' => $program_session->id]) }}" data-record="{{ $program_session->title }}">
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
                                        <x-crud.form.common.create name="session">
                                            @section('session-create-form')
                                                <x-input.hidden method="c" name="program_id" :value="$program->id" />
                                                <x-input.select method="c" name="speaker_id" title="speaker" :options="$speakers" option_value="id" option_name="full_name" icon="person-chalkboard" />
                                                <x-input.select method="c" name="document_id" title="document" :options="$documents" option_value="id" option_name="title" icon="speakation-screen" />
                                                <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort" />
                                                <x-input.text method="c" name="code" title="code" icon="code-simple" />
                                                <x-input.text method="c" name="title" title="title" icon="input-text" />
                                                <x-input.text method="c" name="description" title="description" icon="comment-dots" />
                                                <x-input.datetime method="c" name="start_at" title="start-at" icon="calendar-arrow-down" />
                                                <x-input.datetime method="c" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
                                                <x-input.radio method="c" name="questions_allowed" title="questions" :options="$questions" option_value="value" option_name="title" icon="block-question" />
                                                <x-input.radio method="c" name="questions_auto_start" title="questions-auto-start" :options="$questions_auto_start" option_value="value" option_name="title" icon="block-question" />
                                                <x-input.number method="c" name="questions_limit" title="question-limit" icon="circle-1" />
                                                <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                                            @endsection
                                        </x-crud.form.common.create>
                                        <x-crud.form.common.delete name="session" />
                                        <x-crud.form.common.edit name="session" method="e-s">
                                            @section('session-edit-form')
                                                <x-input.hidden method="e-s" name="program_id" :value="$program->id" />
                                                <x-input.select method="e-s" name="speaker_id" title="speaker" :options="$speakers" option_value="id" option_name="full_name" icon="person-chalkboard" />
                                                <x-input.select method="e-s" name="document_id" title="document" :options="$documents" option_value="id" option_name="title" icon="speakation-screen" />
                                                <x-input.number method="e-s" name="sort_order" title="sort" icon="circle-sort" />
                                                <x-input.text method="e-s" name="code" title="code" icon="code-simple" />
                                                <x-input.text method="e-s" name="title" title="title" icon="input-text" />
                                                <x-input.text method="e-s" name="description" title="description" icon="comment-dots" />
                                                <x-input.datetime method="e-s" name="start_at" title="start-at" icon="calendar-arrow-down" />
                                                <x-input.datetime method="e-s" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
                                                <x-input.radio method="e-s" name="questions_allowed" title="questions" :options="$questions" option_value="value" option_name="title" icon="block-question" />
                                                <x-input.radio method="e-s" name="questions_auto_start" title="questions-auto-start" :options="$questions_auto_start" option_value="value" option_name="title" icon="block-question" />
                                                <x-input.number method="e-s" name="questions_limit" title="question-limit" icon="circle-1" />
                                                <x-input.radio method="e-s" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                                            @endsection
                                        </x-crud.form.common.edit>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @if($program->debates()->count() > 0 )
                            <tr>
                                <td colspan="10">
                                    <div class="card text-bg-dark mt-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-striped table-hover">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-code-simple mx-1"></span> {{ __('common.code') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-comment-dots mx-1"></span> {{ __('common.description') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.voting-started-at') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.voting-finished-at') }}</th>
                                                        <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                                                        <th scope="col" class="text-end"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($program->debates()->get() as $debate)
                                                        <tr>
                                                            <td>{{ $debate->sort_order }}</td>
                                                            <td>{{ $debate->code }}</td>
                                                            <td>{{ $debate->title }}</td>
                                                            <td>{{ $debate->description }}</td>
                                                            <td>{{ $debate->voting_started_at }}</td>
                                                            <td>{{ $debate->voting_finished_at }}</td>
                                                            <td>
                                                                @if($debate->status)
                                                                    <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                                @else
                                                                    <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                                @endif
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                                    <a class="btn btn-info btn-sm" href="{{ route('portal.debate.show', [$program->id, $debate->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                                                        <span class="fa-regular fa-eye"></span>
                                                                    </a>
                                                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                                                        <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#debate-edit-modal" data-route="{{ route('portal.debate.update', [$program->id, $debate->id]) }}" data-resource="{{ route('portal.debate.edit', [$program->id, $debate->id]) }}" data-id="{{ $debate->id }}">
                                                                            <span class="fa-regular fa-pen-to-square"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                                                        <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#debate-delete-modal" data-route="{{ route('portal.debate.destroy', [$program->id, $debate->id]) }}" data-record="{{ $debate->title }}">
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
                                            <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#debate-create-modal" data-route="{{ route('portal.debate.store', $program->id) }}">
                                                <i class="fa-solid fa-plus"></i> {{ __('common.add-new-debate') }}
                                            </button>
                                        </div>
                                        <x-crud.form.common.create name="debate">
                                            @section('debate-create-form')
                                                <x-input.hidden method="c" name="program_id" :value="$program->id" />
                                                <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort" />
                                                <x-input.text method="c" name="code" title="code" icon="code-simple" />
                                                <x-input.text method="c" name="title" title="title" icon="input-text" />
                                                <x-input.text method="c" name="description" title="description" icon="comment-dots" />
                                                <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                                            @endsection
                                        </x-crud.form.common.create>
                                        <x-crud.form.common.delete name="debate" />
                                        <x-crud.form.common.edit name="debate">
                                            @section('debate-edit-form')
                                                <x-input.hidden method="e" name="program_id" :value="$program->id" />
                                                <x-input.number method="e" name="sort_order" title="sort" icon="circle-sort" />
                                                <x-input.text method="e" name="code" title="code" icon="code-simple" />
                                                <x-input.text method="e" name="title" title="title" icon="input-text" />
                                                <x-input.text method="e" name="description" title="description" icon="comment-dots" />
                                                <x-input.radio method="e" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                                            @endsection
                                        </x-crud.form.common.edit>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#default-create-modal" data-route="{{ route('portal.meeting.hall.program.store', ['meeting' => $meeting->id, 'hall' => $hall->id]) }}">
                <i class="fa-solid fa-plus"></i> {{ __('common.create-new-program') }}
            </button>
        </div>
    </div>
    <x-crud.form.common.create>
        @section('default-create-form')
            <x-input.hidden method="c" name="hall_id" :value="$hall->id" />
            <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort" />
            <x-input.text method="c" name="code" title="code" icon="code-simple" />
            <x-input.text method="c" name="title" title="title" icon="input-text" />
            <x-input.text method="c" name="description" title="description" icon="comment-dots" />
            <x-input.file method="c" name="logo" title="logo" icon="image" />
            <x-input.datetime method="c" name="start_at" title="start-at" icon="calendar-arrow-down" />
            <x-input.datetime method="c" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
            <x-input.select method="c" name="type" title="type" :options="$types" option_value="value" option_name="title" icon="person-military-pointing" />
            <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
        @endsection
    </x-crud.form.common.create>
    <x-crud.form.common.delete />
    <x-crud.form.common.edit>
        @section('default-edit-form')
            <x-input.hidden method="e" name="hall_id" :value="$hall->id" />
            <x-input.number method="e" name="sort_order" title="sort" icon="circle-sort" />
            <x-input.text method="e" name="code" title="code" icon="code-simple" />
            <x-input.text method="e" name="title" title="title" icon="input-text" />
            <x-input.text method="e" name="description" title="description" icon="comment-dots" />
            <x-input.file method="e" name="logo" title="logo" icon="image" />
            <x-input.datetime method="e" name="start_at" title="start-at" icon="calendar-arrow-down" />
            <x-input.datetime method="e" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
            <x-input.select method="e" name="type" title="type" :options="$types" option_value="value" option_name="title" icon="person-military-pointing" />
            <x-input.radio method="e" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
        @endsection
    </x-crud.form.common.edit>
@endsection
