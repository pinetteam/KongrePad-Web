@extends('layout.portal.common')
@section('title', $participant->full_name . ' | ' . __('common.participant'))
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="text-center"><span class="fa-duotone fa-screen-users fa-fade"></span> <small>"{{ $participant->full_name }}"</small> {{ __('common.participant') }}</h1>
            <div class="table-responsive">
                <table class="table table-dark table-striped-columns table-bordered">
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.title') }}:</th>
                        <td class="text-start w-25">{{ $participant->title }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.name') }}:</th>
                        <td class="text-start w-25">
                            @if($participant->activity_status)
                                <i style="color:green" class="fa-regular fa-toggle-on"></i>
                            @else
                                <i style="color:red" class="fa-regular fa-toggle-off"></i>
                            @endif
                            {{ $participant->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.meeting') }}:</th>
                        <td class="text-start w-25">{{ $participant->meeting->title }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.identification-number') }}:</th>
                        <td class="text-start w-25">{{ $participant->identification_number }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.organisation') }}:</th>
                        <td class="text-start w-25">{{ $participant->organisation }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.email') }}:</th>
                        <td class="text-start w-25">{{ $participant->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.phone') }}:</th>
                        <td class="text-start w-25">{{ $participant->full_phone }}</td>
                        <th scope="row" class="text-end w-25">{{ __('common.status') }}:</th>
                        <td class="text-start w-25">
                            @if($participant->status)
                                {{ __('common.active') }}
                            @else
                                {{ __('common.passive') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end w-25">{{ __('common.created-by') }}:</th>
                        <td class="text-start w-25"></td>
                        <th scope="row" class="text-end w-25">{{ __('common.created-at') }}:</th>
                        <td class="text-start w-25">{{ $participant->created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center"></h1>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-4 flex-shrink-0 g-4">
                <div class="col card text-bg-dark p-0">
                    <div class="card-header">
                        <h2 class="m-0 text-center h3">{{ __('common.surveys') }}</h2>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"><span class="fa-regular fa-calendar mx-1"></span> {{ __('common.date') }}</th>
                                <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.title') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($survey_votes as $vote)
                                <tr>
                                    <td>{{ $vote->created_at }}</td>
                                    <td>{{ $vote->survey->title }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col card text-bg-dark p-0">
                    <div class="card-header">
                        <h2 class="m-0 text-center h3">{{ __('common.debates') }}</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><span class="fa-regular fa-calendar mx-1"></span> {{ __('common.date') }}</th>
                                    <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.debate') }}</th>
                                    <th scope="col"><span class="fa-regular fa-user-group mx-1"></span> {{ __('common.team') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($debate_votes as $vote)
                                    <tr>
                                        <td>{{ $vote->created_at }}</td>
                                        <td>{{ $vote->debate->title }}</td>
                                        <td>{{ $vote->team->title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col card text-bg-dark p-0">
                    <div class="card-header">
                        <h2 class="m-0 text-center h3">{{ __('common.keypads') }}</h2>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"><span class="fa-regular fa-calendar mx-1"></span> {{ __('common.date') }}</th>
                                <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.keypad') }}</th>
                                <th scope="col"><span class="fa-regular fa-input-text mx-1"></span> {{ __('common.option') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($keypad_votes as $vote)
                                <tr>
                                    <td>{{ $vote->created_at }}</td>
                                    <td>{{ $vote->keypad->keypad }}</td>
                                    <td>{{ $vote->option->option }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col card text-bg-dark p-0">
                    <div class="card-header">
                        <h2 class="m-0 text-center h3">{{ __('common.requested-documents') }}</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><span class="fa-regular fa-calendar mx-1"></span> {{ __('common.date') }}</th>
                                    <th scope="col"><span class="fa-regular fa-presentation-screen mx-1"></span> {{ __('common.document') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requested_documents as $request)
                                    <tr>
                                        <td>{{ $request->created_at }}</td>
                                        <td>{{ $request->document->title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
