<?php

namespace App\Http\Requests\Portal\Meeting\VirtualStand;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class VirtualStandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'meeting_id' => 'required|exists:meetings,id',
                    'file' => ['required', File::types(['pdf', 'pptx', 'ppt', 'ppsx'])->max(10240)],
                    'title' => 'required|max:255',
                    'type' => 'required|in:presentation,publication,other',
                    'sharing_via_email' => 'required|boolean',
                    'status' => 'required|boolean',
                ];
            }
            case 'PATCH' || 'PUT':
            {
                return [
                    'meeting_id' => 'required|exists:meetings,id',
                    'file' => ['nullable', File::types(['pdf', 'pptx', 'ppt', 'ppsx'])->max(10240)],
                    'title' => 'required|max:255',
                    'type' => 'required|in:presentation,publication,other',
                    'sharing_via_email' => 'required|boolean',
                    'status' => 'required|boolean',
                ];
            }
            default:break;
        }
    }
    public function attributes(): array
    {
        return [
            'meeting_id' => __('common.meeting'),
            'file' => __('common.file'),
            'title' => __('common.title'),
            'type' => __('common.type'),
            'sharing_via_email' => __('common.sharing-via-email'),
            'status' => __('common.status'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->with('method', $this->method())->with('name', 'document')->with('route', url()->current())->withErrors($this->validator)->withInput();
    }
}
