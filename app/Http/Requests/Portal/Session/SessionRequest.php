<?php

namespace App\Http\Requests\Portal\Session;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'main_session_id' => 'nullable|exists:sessions,id',
                    'meeting_hall_id' => 'required|exists:meeting_halls,id',
                    'sort_id' => 'nullable|integer',
                    'code' => 'nullable|max:255',
                    'title' => 'required|max:255',
                    'description' => 'nullable|max:65535',
                    'start_at' => 'nullable|date_format:d/m/Y H:i|before_or_equal:finish_at|required_with:finish_at',
                    'finish_at' => 'nullable|date_format:d/m/Y H:i|after_or_equal:start_at|required_with:start_at',
                    'type' => 'required|in:main-session,event,course,presentation,break,other',
                    'status' => 'required|boolean',
                ];
            } case 'PATCH' || 'PUT':
            {
                return [
                    'main_session_id' => 'nullable|exists:sessions,id',
                    'meeting_hall_id' => 'required|exists:meeting_halls,id',
                    'sort_id' => 'nullable|integer',
                    'code' => 'nullable|max:255',
                    'title' => 'required|max:255',
                    'description' => 'nullable|max:65535',
                    'start_at' => 'nullable|date_format:d/m/Y H:i|before_or_equal:finish_at|required_with:finish_at',
                    'finish_at' => 'nullable|date_format:d/m/Y H:i|after_or_equal:start_at|required_with:start_at',
                    'status' => 'required|boolean',
                ];
            }
            default:break;
        }
    }
    public function attributes(): array
    {
        return [
            'main_session_id' => __('common.main-session'),
            'meeting_hall_id' => __('common.meeting-hall'),
            'sort_id' => __('common.sort'),
            'code' => __('common.code'),
            'title' => __('common.title'),
            'description' => __('common.description'),
            'start_at' => __('common.start-at'),
            'finish_at' => __('common.finish-at'),
            'type' => __('common.type'),
            'status' => __('common.status'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->with('method', $this->method())->with('route', url()->current())->withErrors($this->validator)->withInput();
    }
}
