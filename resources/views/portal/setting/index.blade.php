@extends('layout.portal.common')
@section('title', __('common.settings'))
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center">{{ __('common.settings') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="card text-bg-dark">
                        <form action="{{ route('portal.setting.update', 'logo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH" />
                            <div class="card-header">
                                <h2 class="m-0 text-center">{{ __('common.edit-logo') }}</h2>
                            </div>
                            <div class="card-body p-0">
                                <div class="d-block text-center">
                                    @if($customer->logo)
                                        <img src="{{ $customer->logo }}" alt="Red dot" class="my-2 img-thumbnail img-fluid bg-dark" />
                                    @else
                                        <img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==" alt="Red dot" width="200" height="200" class="mb-2 img-thumbnail bg-dark" />
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="form-control form-control-sm" id="logo" accept="image/jpg,image/png,image/gif,image/bmp,image/webp">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <button type="submit" name="submit" class="btn btn-lg btn-primary w-100">
                                    {{__('common.edit-logo')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{__('common.variable')}}</th>
                                <th scope="col">{{__('common.value')}}</th>
                                <th scope="col" class="text-end"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->setting as $system_config => $value)
                                    <tr>
                                        <th scope="row">{{ __('common.'.$system_config) }}</th>
                                        <td>{{ $value }}</td>
                                        <td class="text-end">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                                <button class="btn btn-warning btn-sm w-100" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $system_config }}" data-id="{{ $system_config }}">
                                                    <span class="fa-regular fa-pen-to-square"></span>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="edit-modal-{{ $system_config }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit-modal-label-{{ $system_config }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content bg-dark">
                                                        <form method="post" action="{{ route('portal.setting.update', $system_config) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="PATCH" />
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="edit-modal-label-{{ $system_config }}">{{ __('common.edit') . " " . __('common.'.$system_config) }}</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3 text-center">
                                                                    <label for="value-{{ $system_config }}" class="form-label">
                                                                        <i class="fa-regular fa-gear"></i> {{ __('common.value') }}
                                                                    </label>
                                                                    <input type="text" name="value" class="form-control @error('value')is-invalid @enderror" id="value-{{ $system_config }}" placeholder="{{ $value }}" value="{{ $value }}">
                                                                    @error('value')
                                                                    <div class="invalid-feedback">
                                                                        <i class="fa-regular fa-triangle-exclamation"></i> {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                                                                    <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                                                    <button type="submit" class="btn btn-success w-75">{{ __('common.edit') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
