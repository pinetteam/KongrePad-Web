@extends('layout.portal.common')
@section('title', $survey->title . ' | ' . __('common.participants'))
@section('breadcrumb')
    <li class="breadcrumb-item text-white"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none text-white">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.show', $survey->meeting->id) }}" class="text-decoration-none text-white">{{ $survey->meeting->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.report.survey.index', ['meeting' => $survey->meeting->id]) }}" class="text-decoration-none text-white">{{ __('common.survey-reports') }}</a></li>
    <li class="breadcrumb-item active text-white text-decoration-underline" aria-current="page">{{ '"' . $survey->title. '" ' . __('common.participants') }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-screen-users fa-fade"></span> <small>"{{ $survey->title }}"</small> {{ __('common.participants') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-id-card mx-1"></span> {{ __('common.name') }}</th>
                        <th scope="col"><span class="fa-regular fa-clock mx-1"></span> {{ __('common.vote-at') }}</th>
                        <th scope="col" class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($votes as $vote)
                        <tr>
                            <td>
                                @if($vote->participant->activity_status)
                                    <div class="spinner-grow spinner-grow-sm text-success" role="status"></div>
                                @else
                                    <div class="spinner-border spinner-border-sm text-danger" role="status"></div>
                                @endif
                                {{ $vote->participant->full_name }}
                            </td>
                            <td>{{ $vote->created_at }}</td>
                            <td class="text-end">
                                <div class="btn-group" role="group" aria-label="{{ __('common.processes') }}">
                                    <a class="btn btn-info btn-sm" href="{{ route("portal.meeting.participant.survey",['meeting'=> $survey->meeting->id, 'participant' => $vote->participant->id, 'survey' => $survey->id]) }}" title="{{ __('common.show-report') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.show') }}">
                                        <span class="fa-regular fa-eye"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
