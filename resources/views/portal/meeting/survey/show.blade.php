@extends('layout.portal.common')
@section('title', $survey->title . ' | ' . __('common.survey'))
@section('breadcrumb')
    <li class="breadcrumb-item text-white"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none text-white">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.show', $survey->meeting->id) }}" class="text-decoration-none text-white">{{ $survey->meeting->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.survey.index', ['meeting' => $survey->meeting->id]) }}" class="text-decoration-none text-white">{{ __('common.surveys') }}</a></li>
    <li class="breadcrumb-item active text-white text-decoration-underline" aria-current="page">{{ $survey->title }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="text-center">
                <span class="fa-regular fa-square-poll-vertical fa-fade"></span> <small class="p-2">"{{ $survey->title }}"</small>
                {{ __('common.survey') }}
            </h1>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.survey') }}:</th>
                        <td class="text-start w-25">
                            @if($survey->status)
                                <i style="color:green" class="fa-regular fa-toggle-on"></i>
                            @else
                                <i style="color:red" class="fa-regular fa-toggle-off"></i>
                            @endif
                            {{ $survey->title }}
                        </td>
                        <th scope="row" class="text-end w-25">{{ __('common.description') }}:</th>
                        <td class="text-start w-25">{{ $survey->description }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.start-at') }}:</th>
                        <td>
                            @if($survey->start_at)
                                {{ $survey->start_at }}
                            @else
                                <i class="text-info">{{ __('common.unspecified') }}</i>
                            @endif
                        </td>
                        <th scope="row" class="text-end w-25">{{ __('common.finish-at') }}:</th>
                        <td>
                            @if($survey->finish_at)
                                {{ $survey->finish_at }}
                            @else
                                <i class="text-info">{{ __('common.unspecified') }}</i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.question-count') }}:</th>
                        <td class="text-start w-25">{{ $survey->questions->count() }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.created-at') }}:</th>
                        <td class="text-start w-25">{{ $survey->created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card text-bg-dark">
        <div class="card-header">
            <h2 class="text-center">
                <span class="fa-regular fa-circle-question fa-fade p-2"> </span>{{ __('common.questions') }}
            </h2>
        </div>
        <div class="card-body p-0">
            <div class="card text-bg-dark mt-2">
                @foreach($survey->questions as $question)
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"><span class="fa-regular fa-messages-question mx-1 "></span> {{ __('common.question-title') }}</th>
                                <th scope="col"><span class="fa-regular fa-circle-sort mx-1 "></span> {{ __('common.sort-order') }}</th>
                                <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1  "></span> {{ __('common.option-count') }}</th>
                                <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1 "> </span> {{ __('common.status') }}</th>
                                <th scope="col" class="text-end"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td rowspan="2" style="width: 2%"></td>
                                <td rowspan="1">{{ $question->question }}</td>
                                <td rowspan="1">{{ $question->sort_order }}</td>
                                <td rowspan="1">{{ $question->options->count() }}</td>
                                <td rowspan="1">
                                    @if($question->status)
                                        <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                    @else
                                        <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                    @endif
                                </td>
                                <td class="text-end" rowspan="1">
                                    <div class="btn-group" role="group"
                                         aria-label="{{ __('common.processes') }}">
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                             data-bs-custom-class="kp-tooltip"
                                             data-bs-title="{{ __('common.add-option')}}">
                                            <button type="button"
                                                    class="btn btn-outline-success btn-sm w-100  "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#option-create-modal"
                                                    data-route="{{ route('portal.meeting.survey.option.store',['meeting' => $survey->meeting_id, 'survey' =>  $question->survey_id, 'question' => $question->id,]) }}">
                                                <span class="fa-plus" style="white-space: nowrap"> {{ __('common.add-option') }}</span>
                                            </button>
                                        </div>
                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('portal.meeting.survey.question.show', ['meeting' => $survey->meeting_id, 'survey' => $survey->id, 'question' => $question->id]) }}"
                                           title="{{ __('common.show') }}"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           data-bs-custom-class="kp-tooltip"
                                           data-bs-title="{{ __('common.show') }}">
                                            <span class="fa-regular fa-eye"></span>
                                        </a>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                             data-bs-custom-class="kp-tooltip"
                                             data-bs-title="{{ __('common.edit')}}">
                                            <button class="btn btn-warning btn-sm"
                                                    title="{{ __('common.edit') }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#question-edit-modal"
                                                    data-route="{{ route('portal.meeting.survey.question.update', ['meeting' => $survey->meeting_id , 'survey' => $survey->id, 'question' => $question->id]) }}"
                                                    data-resource="{{ route('portal.meeting.survey.question.edit', ['meeting' => $survey->meeting_id , 'survey' => $survey->id, 'question' => $question->id]) }}"
                                                    data-id="{{ $question->id }}">
                                                <span class="fa-regular fa-pen-to-square"></span>
                                            </button>
                                        </div>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                             data-bs-custom-class="kp-tooltip"
                                             data-bs-title="{{ __('common.delete') }}">
                                            <button class="btn btn-danger btn-sm"
                                                    title="{{ __('common.delete') }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#question-delete-modal"
                                                    data-route="{{ route('portal.meeting.survey.question.destroy', ['meeting'=> $survey->meeting_id, 'survey' => $survey->id, 'question' => $question->id]) }}"
                                                    data-record="{{ $question->question }}">
                                                <span class="fa-regular fa-trash"></span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" colspan="5">
                                    <div class="table-responsive ">
                                        <table class="table table-dark table-striped table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                            <th scope="col"><span class="fa-regular fa-messages-question mx-1"></span> {{ __('common.option-title') }}</th>
                                            <th scope="col"><span class="fa-regular fa-circle-sort mx-1"></span> {{ __('common.sort-order') }}</th>
                                            <th scope="col"><span class="fa-regular fa-toggle-large-on mx-1"></span> {{ __('common.status') }}</th>
                                            <th scope="col" class=""></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($question->options as $option)
                                                <tr>
                                                    <td>{{ $option->option }}</td>
                                                    <td>{{ $option->sort_order }}</td>
                                                    <td>
                                                        @if($option->status)
                                                            <i style="color:green" class="fa-regular fa-toggle-on fa-xg"></i>
                                                        @else
                                                            <i style="color:red" class="fa-regular fa-toggle-off fa-xg"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit')}}">
                                                                <button class="btn btn-warning btn-sm" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#option-edit-modal" data-route="{{ route('portal.meeting.survey.option.update',['meeting' => $survey->meeting_id, 'survey' => $survey->id, 'question' => $option->question_id, 'option' => $option->id]) }}" data-resource="{{ route('portal.meeting.survey.option.edit',['meeting'=>$survey->meeting_id, 'survey' => $question->survey_id , 'question' => $question->id, 'option' => $option->id]) }}" data-id="{{ $option->id }}">
                                                                    <span class="fa-regular fa-pen-to-square"></span>
                                                                </button>
                                                            </div>
                                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.delete') }}">
                                                                <button class="btn btn-danger btn-sm" title="{{ __('common.delete') }}" data-bs-toggle="modal" data-bs-target="#option-delete-modal" data-route="{{ route('portal.meeting.survey.option.show', ['meeting' => $survey->meeting_id, 'survey' => $question->survey_id , 'question' => $question->id, 'option' => $option->id]) }}" data-record="{{ $option->option }}">
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
                                </td>
                            </tr>
                            </tbody>
                        </table>
                @endforeach
                            <tr>
                                <div class="card-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#question-create-modal" data-route="{{ route('portal.meeting.survey.question.store',['meeting' => $survey->meeting_id, 'survey' => $survey->id]) }}">
                                        <i class="fa-solid fa-plus"></i> {{ __('common.create-new-question') }}
                                    </button>
                                </div>
                            </tr>
                    </div>
            </div>
        </div>
    </div>

    <x-crud.form.common.create method="c-o" name="option">
        @section('option-create-form')
            <x-input.hidden method="c-o" name="survey_id" :value="$survey->id"/>
            <x-input.hidden method="c-o" name="question_id" value="1"/>
            <x-input.text method="c-o" name="option" title="option" icon="list-dropdown"/>
            <x-input.number method="c-o" name="sort_order" title="sort" icon="circle-sort"/>
            <x-input.radio method="c-o" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on"/>
        @endsection
    </x-crud.form.common.create>
    <x-crud.form.common.delete name="option"/>
    <x-crud.form.common.edit method="e-o" name="option">
        @section('option-edit-form')
            <x-input.hidden method="e-o" name="survey_id" :value="$survey->id"/>
            <x-input.text method="e-o" name="option" title="option" icon="list-dropdown"/>
            <x-input.number method="e-o" name="sort_order" title="sort" icon="circle-sort"/>
            <x-input.radio method="e-o" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on"/>
        @endsection
    </x-crud.form.common.edit>


    <x-crud.form.common.create name="question">
        @section('question-create-form')
            <x-input.hidden method="c" name="survey_id" :value="$survey->id"/>
            <x-input.text method="c" name="question" title="question" icon="messages-question"/>
            <x-input.number method="c" name="sort_order" title="sort" icon="circle-sort"/>
            <x-input.radio method="c" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on"/>
        @endsection
    </x-crud.form.common.create>

    <x-crud.form.common.delete name="question"/>

    <x-crud.form.common.edit name="question">
        @section('question-edit-form')
            <x-input.hidden method="e" name="survey_id" :value="$survey->id"/>
            <x-input.text method="e" name="question" title="question" icon="messages-question"/>
            <x-input.number method="e" name="sort_order" title="sort" icon="circle-sort"/>
            <x-input.radio method="e" name="status" title="status" :options="$statuses" option_value="value" option_name="title" icon="toggle-large-on"/>
        @endsection
    </x-crud.form.common.edit>
@endsection
