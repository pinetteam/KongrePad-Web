@extends('layout.portal.common')
@section('title', $meeting->title . ' | ' .  __('common.question-reports'))
@section('breadcrumb')
    <li class="breadcrumb-item text-white"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.show', $meeting->id) }}" class="text-decoration-none">{{ $meeting->title }}</a></li>
    <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.question-reports') }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-question"></span> {{ __('common.question-reports') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <caption class="text-end me-3">
                        {{ $participants->links() }}
                    </caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.name') }}</th>
                        <th scope="col"><span class="fa-regular fa-question mx-1"></span> {{ __('common.questions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($participants as $participant)
                        <tr>
                            <td>{{ $participant->full_name }}</td>
                            <td>{{ $participant->sessionQuestions()->where([['is_hidden_name', 0], ['selected_for_show', 1]])->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
