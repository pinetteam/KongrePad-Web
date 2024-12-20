@extends('layout.portal.common')
@section('title', $title->title . ' | ' . __('common.participants'))
@section('breadcrumb')
    <li class="breadcrumb-item text-white"><a href="{{ route("portal.meeting.index") }}" class="text-decoration-none text-white">{{ __('common.meetings') }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.show', $title->program->hall->meeting->id) }}" class="text-decoration-none text-white">{{ $title->program->hall->meeting->title }}</a></li>
    <li class="breadcrumb-item text-white"><a href="{{ route('portal.meeting.report.debate.index', ['meeting' => $title->program->hall->meeting->id]) }}" class="text-decoration-none text-white">{{ __('common.debate-reports') }}</a></li>
    <li class="breadcrumb-item active text-white text-decoration-underline" aria-current="page">{{ '"' . $title->title. '" ' . __('common.participants') }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"><span class="fa-duotone fa-screen-users fa-fade"></span> <small>"{{ $title->title }}"</small> {{ __('common.participants') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <caption class="text-end me-3">
                        {{ $votes->links() }}
                    </caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><span class="fa-regular fa-id-card mx-1"></span> {{ __('common.name') }}</th>
                        <th scope="col"><span class="fa-regular fa-pen mx-1"></span> {{ __('common.vote') }}</th>
                        <th scope="col" class="text-end px-4"><span class="fa-regular fa-clock mx-1"></span> {{ __('common.vote-at') }}</th>
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
                            <td>{{ $vote->team->title }}</td>
                            <td class="text-end px-4">{{ $vote->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
