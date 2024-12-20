<?php

namespace App\Http\Requests\Portal\Meeting\Survey\Vote;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
                    'survey_id' => 'required|exists:meeting_surveys,id',
                    'question_id' => 'required|exists:meeting_survey_questions,id',
                    'option_id' => 'required|exists:meeting_survey_question_options,id',
                    'sort_order' => 'nullable|integer',
                    'option' => 'required|max:255',
                    'status' => 'required|boolean',
                ];
            }
            default:break;
        }
    }
    public function attributes(): array
    {
        return [
            'survey_id' => __('common.survey'),
            'question_id' => __('common.question'),
            'option_id' => __('common.option'),
            'sort_order' => __('common.sort-order'),
            'option' => __('common.option'),
            'status' => __('common.status'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->with('method', $this->method())->with('route', url()->current())->withErrors($this->validator)->withInput();
    }
}
