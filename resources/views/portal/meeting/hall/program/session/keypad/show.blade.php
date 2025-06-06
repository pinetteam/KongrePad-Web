@extends('layout.portal.meeting-detail')
@section('title', $keypad->keypad)
@section('breadcrumb')
    <li class="breadcrumb-item text-white"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none text-white">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.show', $keypad->session->program->hall->meeting->id) }}" class="text-decoration-none text-white">{{ $keypad->session->program->hall->meeting->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.hall.index', ['meeting' => $keypad->session->program->hall->meeting->id]) }}" class="text-decoration-none text-white">{{ __('common.halls') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.hall.show', ['meeting' => $keypad->session->program->hall->meeting->id, 'hall' => $keypad->session->program->hall->id]) }}" class="text-decoration-none text-white">{{ $keypad->session->program->hall->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.hall.program.index', ['meeting' => $keypad->session->program->hall->meeting->id, 'hall' => $keypad->session->program->hall->id]) }}" class="text-decoration-none text-white">{{ __('common.programs') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.hall.program.show', ['meeting' => $keypad->session->program->hall->meeting->id, 'hall' => $keypad->session->program->hall->id, 'program' => $keypad->session->program->id]) }}" class="text-decoration-none text-white">{{ $keypad->session->program->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.hall.program.session.show', ['meeting' => $keypad->session->program->hall->meeting->id, 'hall' => $keypad->session->program->hall->id, 'program' => $keypad->session->program->id, 'session' => $keypad->session->id]) }}" class="text-decoration-none text-white">{{ $keypad->session->program->title }}</a></li>
    <li class="breadcrumb-item active text-white text-decoration-underline" aria-current="page">{{ $keypad->title }}</li>
@endsection
@section('meeting_content')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-tablet fa-fade"></span> <small>"{{ $keypad->keypad }}"</small></h1>
        </div>
            <div class="table-responsive">
                <table class="table table-dark table-striped-columns table-bordered">
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.created-by') }}:</th>
                        <td class="text-start w-25">{{ $keypad->created_by_name }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.created-at') }}:</th>
                        <td class="text-start w-25">{{ $keypad->created_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="card text-bg-dark">
                <div class="card-header">
                    <h2 class="m-0 text-center">{{ __('common.options') }}</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"><span class="fa-regular fa-list-dropdown mx-1"></span> {{ __('common.option-title') }}</th>
                                <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort-order') }}</th>
                                <th scope="col" class="text-end"></th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($keypad->options as $option)
                                <tr>
                                    <td>{{$option->option}}</td>
                                    <td>{{$option->sort_order}}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit')}}">
                                                <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="offcanvas" data-bs-target="#option-edit-modal" data-route="{{ route('portal.meeting.hall.program.session.keypad.option.update', ['meeting'=>$keypad->session->program->hall->meeting_id, 'hall'=>$keypad->session->program->hall_id, 'program'=>$keypad->session->program_id, 'session'=> $keypad->session->id, 'keypad' => $keypad->id, 'option' => $option->id]) }}" data-resource="{{ route('portal.meeting.hall.program.session.keypad.option.edit', ['meeting'=>$keypad->session->program->hall->meeting_id, 'hall'=>$keypad->session->program->hall_id, 'program'=>$keypad->session->program_id, 'session'=> $keypad->session->id, 'keypad' => $keypad->id, 'option' => $option->id]) }}" data-id="{{ $option->id }}">
                                                    <span class="fa-regular fa-pen-to-square"></span>
                                                </button>
                                            </div>
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                                <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="offcanvas" data-bs-target="#option-delete-modal" data-route="{{ route('portal.meeting.hall.program.session.keypad.option.destroy', ['meeting'=>$keypad->session->program->hall->meeting_id, 'hall'=>$keypad->session->program->hall_id, 'program'=>$keypad->session->program_id, 'session'=> $keypad->session->id, 'keypad' => $keypad->id, 'option' => $option->id]) }}" data-record="{{ $option->option }}">
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
                    <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="offcanvas" data-bs-target="#option-create-modal" data-route="{{ route('portal.meeting.hall.program.session.keypad.option.store',['meeting'=>$keypad->session->program->hall->meeting_id, 'hall'=>$keypad->session->program->hall_id, 'program'=>$keypad->session->program_id, 'session'=> $keypad->session->id, 'keypad' => $keypad->id]) }}">
                        <i class="fa-solid fa-plus"></i> {{ __('common.create-new-option') }}
                    </button>
                </div>
                <x-crud.form.common.create name="option">
                    @section('option-create-form')
                        <x-input.hidden method="c" name="keypad_id" :value="$keypad->id"/>
                        <x-input.text method="c" name="option" title="option" icon="list-dropdown" />
                        <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort" />
                    @endsection
                </x-crud.form.common.create>
                <x-crud.form.common.delete name="option" />
                <x-crud.form.common.edit name="option">
                    @section('option-edit-form')
                        <x-input.hidden method="e" name="keypad_id" :value="$keypad->id"/>
                        <x-input.text method="e" name="option" title="option" icon="list-dropdown" />
                        <x-input.number method="e" name="sort_order" title="sort" icon="circle-sort" />
                    @endsection
                </x-crud.form.common.edit>
            </div>
        </div>
@endsection
