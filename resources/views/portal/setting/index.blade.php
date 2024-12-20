@extends('layout.portal.common')
@section('title', __('common.settings'))
@section('breadcrumb')
    <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.settings') }}</li>
@endsection
@section('body')
    <div class="card text-bg-dark">
        <div class="card-header">
            <h1 class="m-0 text-center">{{ __('common.settings') }}</h1>
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">

                    <div class="card text-bg-dark">
                        <div class="card-body p-2">
                            <div class="d-block text-center">
                                <h1>{{ __('common.credit') . ': ' . $customer->credit }}</h1>
                                <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.purchase') }}">
                                    <button class="btn btn-warning btn-sm w-100" title="{{ __('common.edit') }}" href="#">
                                        <span class="fa-regular fa-shopping-cart"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-bg-dark">
                        <form action="{{ route('portal.setting.update', $customer->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH" />
                            <div class="card-header">
                                <h3 class="m-0 text-center">{{ __('common.edit-logo') }}</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="d-block text-center">
                                    @if($customer->logo)
                                        <img src="{{ $customer->logo }}" alt="Red dot" class="img-thumbnail img-fluid bg-dark" />
                                    @else
                                        <img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==" alt="Red dot" width="200" height="200" class="img-thumbnail bg-dark" />
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="form-control form-control-sm" id="logo" accept="image/png">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <button type="submit" name="submit" class="btn btn-lg btn-success w-100">
                                    <i class="fa-solid fa-image"></i> {{__('common.edit-logo')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12">
                    @foreach($setting_groups as $group => $settings)
                        <h1>{{ __('common.' . $group) }}</h1>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover table-bordered mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"><span class="fa-regular fa-sliders-simple mx-1"></span> {{__('common.variable')}}</th>
                                <th scope="col"><span class="fa-regular fa-screwdriver-wrench mx-1"></span> {{__('common.value')}}</th>
                                <th scope="col" class="text-end"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <th scope="row">{{ __('common.'.$setting->title) }}</th>
                                        <td>{{ $setting->value }}</td>
                                        <td class="text-end">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="kp-tooltip" data-bs-title="{{ __('common.edit') }}">
                                                <button class="btn btn-warning btn-sm w-100" title="{{ __('common.edit') }}" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $setting->variable }}" data-id="{{ $setting->variable }}">
                                                    <span class="fa-regular fa-pen-to-square"></span>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="edit-modal-{{ $setting->variable }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit-modal-label-{{ $setting->variable }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content bg-dark">
                                                        <form method="post" action="{{ route('portal.setting.update', $setting->id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="PATCH" />
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="edit-modal-label-{{ $setting->variable }}">{{ __('common.edit') . " " . __('common.'.$setting->title) }}</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3 text-center">
                                                                    @if($setting->type == 'text' || $setting->type == 'number')
                                                                        <input type="{{$setting->type}}" name="value" class="form-control @error('value')is-invalid @enderror" id="value-{{ $setting->variable }}" placeholder="{{ $setting->value }}" value="{{ $setting->value }}" />
                                                                    @elseif($setting->type == 'select')
                                                                        <select name="value" class="form-select @error('value')is-invalid @enderror">
                                                                            @foreach(json_decode($setting->type_variables, true) as $option)
                                                                                <option value="{{$option['value']}}"{{ $setting->value == $option['value']? ' selected' : '' }}>{{ $option['title'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @elseif($setting->type == 'radio')
                                                                        <div class="btn-group w-100 @error('value')is-invalid @enderror" role="group" aria-label="{{ __('common.'.$setting->title) }}">
                                                                            @foreach(json_decode($setting->type_variables, true) as $option)
                                                                                <input type="radio" name="value" class="btn-check" id="value-{{ $option['value'] }}" value="{{ $option['value'] }}"{{ (( $setting->value !== null) && $setting->value == $option['value']) ? ' checked' : '' }} />
                                                                                <label class="btn btn-outline-{{ $value['color'] }}" for="value-{{ $option['value'] }}">{{ $option['title'] }}</label>
                                                                            @endforeach
                                                                        </div>
                                                                    @elseif($setting->type == 'checkbox')
                                                                        <div class="btn-group w-100 @error('value')is-invalid @enderror" role="group" aria-label="{{ __('common.'.$setting->title) }}">
                                                                            @foreach(json_decode($setting->type_variables, true) as $option)
                                                                                <input type="checkbox" name="value" class="form-check-input" id="value-{{ ['value'] }}" value="{{ $option['value'] }}"{{ (( $setting->value !== null) && $setting->value == $option['value']) ? ' checked' : '' }} />
                                                                                <label class="btn btn-outline-{{ $value['color'] }}" for="value-{{ $option['value'] }}">{{ $option['title'] }}</label>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                    @error('value')
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
