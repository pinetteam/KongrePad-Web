<?php

namespace App\Http\Controllers\Portal\Meeting\Hall\Program\Session;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Meeting\Hall\Program\Session\ProgramSessionRequest;
use App\Http\Resources\Portal\Meeting\Hall\Program\Session\ProgramSessionResource;
use App\Models\Meeting\Hall\Program\Session\ProgramSession;
use Illuminate\Support\Facades\Auth;

class ProgramSessionController extends Controller
{
    public function store(ProgramSessionRequest $request, string $program_id)
    {
        if ($request->validated()) {
            $program_session = new ProgramSession();
            $program_session->program_id = $request->input('program_id');
            $program_session->speaker_id = $request->input('speaker_id');
            $program_session->document_id = $request->input('document_id');
            $program_session->sort_order = $request->input('sort_order');
            $program_session->code = $request->input('code');
            $program_session->title = $request->input('title');
            $program_session->description = $request->input('description');
            $program_session->start_at = $request->input('start_at');
            $program_session->finish_at = $request->input('finish_at');
            $program_session->questions = $request->input('questions');
            $program_session->questions_auto_start = $request->input('questions_auto_start');
            $program_session->is_questions_started = $request->input('questions_auto_start');
            $program_session->question_limit = $request->input('question_limit');
            $program_session->status = $request->input('status');
            if ($program_session->save()) {
                $program_session->created_by = Auth::user()->id;
                $program_session->save();
                return back()->with('success',__('common.created-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function show(string $program_id, string $id)
    {
        $session = Auth::user()->customer->programSessions()->findOrFail($id);
        $keypads = $session->keypads()->get();
        $statuses = [
            'active' => ["value" => 0, "title" => __('common.passive'), 'color' => 'danger'],
            'passive' => ["value" => 1, "title" => __('common.active'), 'color' => 'success'],
        ];
        return view('portal.program.session.show', compact(['keypads', 'session', 'statuses']));
    }
    public function edit(string $program_id, string $id)
    {
        $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
        return new ProgramSessionResource($program_session);
    }
    public function update(ProgramSessionRequest $request, string $program_id, string $id)
    {
        if ($request->validated()) {
            $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
            $program_session->speaker_id = $request->input('speaker_id');
            $program_session->document_id = $request->input('document_id');
            $program_session->sort_order = $request->input('sort_order');
            $program_session->code = $request->input('code');
            $program_session->title = $request->input('title');
            $program_session->description = $request->input('description');
            $program_session->start_at = $request->input('start_at');
            $program_session->finish_at = $request->input('finish_at');
            $program_session->questions = $request->input('questions');
            $program_session->questions_auto_start = $request->input('questions_auto_start');
            $program_session->is_questions_started = $request->input('questions_auto_start');
            $program_session->question_limit = $request->input('question_limit');
            $program_session->status = $request->input('status');
            if ($program_session->save()) {
                $program_session->edited_by = Auth::user()->id;
                $program_session->save();
                return back()->with('success',__('common.edited-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function destroy(string $program_id, string $id)
    {
        $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
        if ($program_session->delete()) {
            $program_session->deleted_by = Auth::user()->id;
            $program_session->save();
            return back()->with('success', __('common.deleted-successfully'));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }

    public function start_stop(string $program_id, string $id)
    {
        $program = Auth::user()->customer->programs()->findOrFail($program_id);
        $meeting_hall = Auth::user()->customer->meetingHalls()->findOrFail($program_id);
        foreach($meeting_hall->programSessions as $session){
            if($session->id == $id)
                continue;
            $session->is_started = 0;
            $session->save();
        }
        $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
        $program_session->is_started = !$program_session->is_started;
        if ($program_session->save()) {
            if($program_session->is_started)
                return back()->with('success',__('common.session-started'));
            else
                return back()->with('success',__('common.session-stopped'));
        } else {
            return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }
    public function start_stop_questions(string $program_id, string $id)
    {
        $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
        $program_session->is_questions_started = !$program_session->is_questions_started;
        if ($program_session->save()) {
            if($program_session->is_questions_started)
                return back()->with('success',__('common.session-questions-started'));
            else
                return back()->with('success',__('common.session-questions-stopped'));
        } else {
            return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }

    public function edit_question_limit(string $program_id, string $id, int $increment){
        $program_session = Auth::user()->customer->programSessions()->findOrFail($id);
        $program_session->question_limit = $program_session->question_limit + $increment;
        if($program_session->question_limit > 0)
            $program_session->save();
        return back();
    }
}
