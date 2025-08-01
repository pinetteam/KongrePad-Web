<?php

namespace App\Http\Requests\Portal\Meeting;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        switch($this->method())
        {
            case 'POST' || 'PATCH' || 'PUT':
            {
                return [
                    'code' => 'required|max:511',
                    'banner' => 'nullable|file|max:5120',
                    'title' => 'required|max:511',
                    'type' => 'required|in:standard,premium',
                    'start_at' => 'required|date_format:Y-m-d|before_or_equal:finish_at|required_with:finish_at',
                    'finish_at' => 'required|date_format:Y-m-d|after_or_equal:start_at|required_with:start_at',
                    'status' => 'required|boolean',
                ];
            }
            case 'PATCH' || 'PUT':
            {
                return [
                    'code' => 'required|max:511',
                    'banner' => 'nullable|file|max:5120',
                    'title' => 'required|max:511',
                    'start_at' => 'required|date_format:Y-m-d|before_or_equal:finish_at|required_with:finish_at',
                    'finish_at' => 'required|date_format:Y-m-d|after_or_equal:start_at|required_with:start_at',
                    'status' => 'required|boolean',
                ];
            }
            default:break;
        }
    }
    public function attributes(): array
    {
        return [
            'code' => __('common.code'),
            'banner' => __('common.banner'),
            'title' => __('common.title'),
            'type' => __('common.type'),
            'start_at' => __('common.start-at'),
            'finish_at' => __('common.finish-at'),
            'status' => __('common.status'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->with('method', $this->method())->with('name', 'meeting')->with('route', url()->current())->withErrors($this->validator)->withInput();
    }
}
