<?php

namespace App\Http\Controllers\Portal\Meeting\Survey\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Meeting\Survey\Question\QuestionRequest;
use App\Http\Resources\Portal\Meeting\Survey\Question\QuestionResource;
use App\Models\Meeting\Survey\Question\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function store(QuestionRequest $request, int $meeting, int $survey)
    {
        if ($request->validated()) {
            $question = new Question();
            $question->sort_order = $request->input('sort_order');
            $question->survey_id = $survey;
            $question->question = $request->input('question');
            $question->status = $request->input('status');
            if ($question->save()) {
                $question->created_by = Auth::user()->id;
                $question->save();
                return back()->with('success',__('common.created-successfully'));
            } else {
                return back()->with('create_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function show(int $meeting, int $survey, int $id)
    {
        $survey = Auth::user()->customer->surveys()->findOrFail($survey);
        $question = $survey->questions()->findOrFail($id);
        $statuses = [
            'passive' => ['value' => 0, "title" => __('common.passive'), 'color' => 'danger'],
            'active' => ['value' => 1, "title" => __('common.active'), 'color' => 'success'],
        ];
        return view('portal.meeting.survey.question.show', compact(['survey', 'question', 'statuses']));
    }
    public function edit(int $meeting, int $survey, int $id)
    {
        $survey = Auth::user()->customer->surveys()->findOrFail($survey);
        $question = $survey->questions()->findOrFail($id);
        return new QuestionResource($question);
    }
    public function update(QuestionRequest $request, int $meeting, int $survey, int $id)
    {
        if ($request->validated()) {
            $survey = Auth::user()->customer->surveys()->findOrFail($survey);
            $question = $survey->questions()->findOrFail($id);
            $question->sort_order = $request->input('sort_order');
            $question->survey_id = $request->input('survey_id');
            $question->question = $request->input('question');
            $question->status = $request->input('status');
            if ($question->save()) {
                $question->updated_by = Auth::user()->id;
                $question->save();
                return back()->with('success', __('common.edited-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function destroy(int $meeting, int $survey, int $id)
    {
        $survey = Auth::user()->customer->surveys()->findOrFail($survey);
        $question = $survey->questions()->findOrFail($id);
        if ($question->delete()) {
            $question->deleted_by = Auth::user()->id;
            $question->save();
            return back()->with('success', __('common.deleted-successfully'));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }
}
