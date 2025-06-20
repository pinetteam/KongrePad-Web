<?php

namespace App\Http\Requests\Portal\Meeting\Hall\Program\Session;

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
            case 'POST' || 'PATCH' || 'PUT':
            {
                return [
                    'sort_order' => 'nullable|integer',
                    'program_id' => 'required|integer',
                    'speaker_id' => 'nullable|exists:meeting_participants,id',
                    'document_id' => 'nullable|exists:meeting_documents,id',
                    'code' => 'nullable|max:255',
                    'title' => 'required|max:255',
                    'description' => 'nullable|max:65535',
                    'start_at' => 'nullable',
                    'finish_at' => 'nullable',
                    'questions_allowed' => 'required|in:0,1',
                    'questions_limit' => 'nullable|integer',
                    'questions_auto_start' => 'required|in:0,1',
                    'status' => 'required|in:0,1',
                ];
            }
            default:break;
        }
    }
    public function attributes(): array
    {
        return [
            'sort_order' => __('common.sort'),
            'program_id' => __('common.program'),
            'speaker_id' => __('common.speaker'),
            'document_id' => __('common.document'),
            'code' => __('common.code'),
            'title' => __('common.title'),
            'description' => __('common.description'),
            'start_at' => __('common.start-at'),
            'finish_at' => __('common.finish-at'),
            'questions_allowed' => __('common.questions-allowed'),
            'questions_limit' => __('common.questions-limit'),
            'questions_auto_start' => __('common.questions-auto-start'),
            'status' => __('common.status'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->with('method', $this->method())->with('name', 'session')->with('route', url()->current())->withErrors($validator)->withInput();
    }
}
