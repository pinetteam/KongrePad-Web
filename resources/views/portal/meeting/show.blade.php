@extends('layout.portal.common')
@section('title', __('common.meeting').' | '.$meeting->title)
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center">{{ __('common.meeting').' | '.$meeting->title }}</h1>
        </div>
        <div class="card-body">
            <div class="row row row-cols-1 row-cols-sm-2 flex-shrink-0 g-2">
                <div class="col card text-bg-dark p-0">
                    <div class="card-header">
                        <h2 class="m-0 text-center h3">{{ __('common.meeting') }}</h2>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}:</b> {{ $meeting->title }}</li>
                            <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}:</b> {{ $meeting->start_at }}</li>
                            <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}:</b> {{ $meeting->finish_at }}</li>
                            <li class="list-group-item bg-dark text-white"><b><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}:</b>
                                @if($meeting->status)
                                    {{ __('common.active') }}
                                @else
                                    {{ __('common.passive') }}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col card text-bg-dark mt-2">
                    <div class="card-header">
                        <h1 class="m-0 text-center">{{ __('common.meeting-halls') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                                    <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                                    <th scope="col" class="text-end"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($meeting_halls as $meeting_hall)
                                    <tr>
                                        <td>{{ $meeting_hall->title }}</td>
                                        <td>
                                            @if($meeting_hall->status)
                                                <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                            @else
                                                <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                <a class="btn btn-success btn-sm" href="{{ route('portal.operator-board.index',[ $meeting_hall->id, 0]) }}" title="{{ __('common.operator-board') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.operator-board') }}">
                                                    <span class="fa-regular fa-presentation-screen"></span>
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{ route('portal.meeting-hall.show', [$meeting_hall->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                                    <span class="fa-regular fa-eye"></span>
                                                </a>
                                                <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                                    <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#meeting-hall-edit-modal" data-route="{{ route('portal.meeting-hall.update', [$meeting_hall->id]) }}" data-resource="{{ route('portal.meeting-hall.edit', [$meeting_hall->id]) }}" data-id="{{ $meeting_hall->id }}">
                                                        <span class="fa-regular fa-pen-to-square"></span>
                                                    </button>
                                                </div>
                                                <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                                    <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#meeting-hall-delete-modal" data-route="{{ route('portal.meeting-hall.destroy', [$meeting_hall->id]) }}" data-record="{{ $meeting_hall->title }}">
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
                        <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#meeting-hall-create-modal" data-route="{{ route('portal.meeting-hall.store')}}">
                            <i class="fa-solid fa-plus"></i> {{ __('common.add-new-meeting-hall') }}
                        </button>
                    </div>
                    <x-crud.form.common.create name="meeting-hall">
                        @section('meeting-hall-create-form')
                            <x-input.hidden method="mhc" name="meeting_id" :value="$meeting->id"/>
                            <x-input.text method="mhc" name="title" title="title" icon="input-text" />
                            <x-input.radio method="mhc" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                        @endsection
                    </x-crud.form.common.create>
                    <x-crud.form.common.delete name="meeting-hall" />
                    <x-crud.form.common.edit name="meeting-hall" method="mhe">
                        @section('meeting-hall-edit-form')
                            <x-input.hidden method="mhe" name="meeting_id" :value="$meeting->id" />
                            <x-input.text method="mhe" name="title" title="title" icon="input-text" />
                            <x-input.radio method="mhe" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
                        @endsection
                    </x-crud.form.common.edit>
                </div>
            </div>
        </div>
    </div>

    <div class="card text-bg-dark mt-2">
        <div class="card-header">
            <h1 class="m-0 text-center">{{ __('common.surveys') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">

                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-pen-field mx-1"></span> {{ __('common.title') }}</th>
                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.meeting-title') }}</th>
                        <th scope="col"><span class="fa-regular fa-calendar-arrow-up mx-1"></span> {{ __('common.start-at') }}</th>
                        <th scope="col"><span class="fa-regular fa-calendar-arrow-down mx-1"></span> {{ __('common.finish-at') }}</th>
                        <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                        <th scope="col" class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($surveys as $survey)
                            <tr>
                                <td>{{$survey->title}}</td>
                                <td>{{$survey->meeting->title}}</td>
                                <td>
                                    @if($survey->start_at)
                                        {{$survey->start_at}}
                                    @else
                                        <i class="text-info">{{__('common.unspecified')}}</i>
                                    @endif
                                </td>
                                <td>
                                    @if($survey->finish_at)
                                        {{$survey->finish_at}}
                                    @else
                                        <i class="text-info">{{__('common.unspecified')}}</i>
                                    @endif
                                </td>
                                <td>
                                    @if($survey->status)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                        {{--show button--}}
                                        <a class="btn btn-info btn-sm" href="{{ route('portal.survey.show',[ 'meeting_id'=>$survey->meeting_id ,'survey'=> $survey->id]) }}" title="{{ __('common.show') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                            <span class="fa-regular fa-eye"></span>
                                        </a>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit')}}">
                                            {{--edit button--}}
                                            <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#survey-edit-modal" data-route="{{ route('portal.survey.update',[ 'meeting_id'=>$meeting->id ,'survey'=> $survey->id]) }}" data-resource="{{ route('portal.survey.edit',[ 'meeting_id'=>$survey->meeting_id ,'survey'=> $survey->id]) }}" data-id="{{ $survey->id }}">
                                                <span class="fa-regular fa-pen-to-square"></span>
                                            </button>
                                        </div>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                            <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#survey-delete-modal" data-route="{{ route('portal.survey.destroy',[ 'meeting_id'=>$survey->meeting_id ,'survey'=> $survey->id]) }}" data-record="{{ $survey->title }}">
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
        {{--create button--}}
        <div class="card-footer d-flex justify-content-center">
            <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#survey-create-modal" data-route="{{ route('portal.survey.store', $meeting->id) }}">
                <i class="fa-solid fa-plus"></i> {{ __('common.create-new-survey') }}
            </button>
        </div>

        <x-crud.form.common.create name="survey">
            @section('survey-create-form')
                <x-input.hidden method="c" name="meeting_id" :value="$meeting->id"/>
                <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort" />
                <x-input.text method="c" name="title" title="title" icon="pen-field" />
                <x-input.text method="c" name="description" title="description" icon="comment-dots" />
                <x-input.datetime method="c" name="start_at" title="start-at" icon="calendar-arrow-down" />
                <x-input.datetime method="c" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
                <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            @endsection
        </x-crud.form.common.create>
        <x-crud.form.common.delete name="survey"/>
        <x-crud.form.common.edit name="survey">
            @section('survey-edit-form')
                <x-input.hidden method="e" name="meeting_id" :value="$meeting->id"/>
                <x-input.number method="e" name="sort_order" title="sort" icon="circle-sort" />
                <x-input.text method="e" name="title" title="title" icon="pen-to-square" />
                <x-input.text method="e" name="description" title="description" icon="comment-dots" />
                <x-input.datetime method="e" name="start_at" title="start-at" icon="calendar-arrow-down" />
                <x-input.datetime method="e" name="finish_at" title="finish-at" icon="calendar-arrow-down" />
                <x-input.radio method="e" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on" />
            @endsection
        </x-crud.form.common.edit>
    </div>

@endsection
