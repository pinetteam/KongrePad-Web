@extends('layout.portal.common')
@section('title', $participant->fullname . ' | '. $survey->title . ' | ' . __('common.votes'))
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="text-center">
                <span class="fa-regular fa-square-poll-vertical fa-fade"></span> <small>"{{ $survey->title }}"</small> {{ __('common.survey') }}
            </h1>
            <div class="table-responsive">
                <table class="table table-dark table-striped-columns table-bordered">
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
                        <td class="text-start w-25">{{ $survey->start_at }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.finish-at') }}:</th>
                        <td class="text-start w-25">{{ $survey->finish_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-option fa-fade"></span> <small>"{{ $participant->fullname }}"</small> {{ __('common.votes') }}</h1>
        </div>
        <div class="card-body p-0">
            <ol class="list-group list-group-numbered">
                @foreach($survey_votes as $vote)
                    <li class="list-group-item d-flex justify-content-between align-items-start bg-dark border-dark-subtle text-white">
                        <div class="ms-2 w-100 overflow-hidden">
                            <div class="fw-bold">{{ $vote->question->question }}</div>
                            <hr />
                            <ul class="list-group">
                            @foreach($vote->question->options as $option)
                                @if($vote->option == $option)
                                        <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-start border-dark-subtle text-dark text-body-emphasis overflow-scroll">{{$option->option}}</li>
                                @elseif($vote->option != $option)
                                        <li class="list-group-item d-flex justify-content-between align-items-start bg-dark border-dark text-white border-dark-subtle overflow-scroll">{{$option->option}}</li>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
