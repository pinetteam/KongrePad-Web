<?php

namespace App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Keypad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Meeting\Hall\Program\Session\Keypad\KeypadRequest;
use App\Http\Resources\Portal\Meeting\Hall\Program\Session\Keypad\KeypadResource;
use App\Models\Meeting\Hall\Program\Session\Keypad\Keypad;
use Illuminate\Support\Facades\Auth;

class KeypadController extends Controller
{
    public function store(KeypadRequest $request, string $meeting, string $hall, string $program, string $session)
    {
        if ($request->validated()) {
            $keypad = new Keypad();
            $keypad->session_id = $request->input('session_id');
            $keypad->sort_order = $request->input('sort_order');
            $keypad->keypad = $request->input('keypad');
            if ($keypad->save()) {
                $keypad->created_by = Auth::user()->id;
                $keypad->save();
                return back()->with('success', __('common.created-successfully'));
            } else {
                return back()->with('create_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function show(string $meeting, string $hall, string $program, string $session, string $id)
    {
        $keypad = Auth::user()->customer->keypads()->findOrFail($id);
        $options = $keypad->options()->get();
        $statuses = [
            'passive' => ["value" => 0, "title" => __('common.passive'), 'color' => 'danger'],
            'active' => ["value" => 1, "title" => __('common.active'), 'color' => 'success'],
        ];
        return view('portal.meeting.hall.program.session.keypad.show', compact(['options', 'keypad', 'statuses']));
    }
    public function edit(string $meeting, string $hall, string $program, string $session, string $id)
    {
        $keypad = Auth::user()->customer->keypads()->findOrFail($id);
        return new KeypadResource($keypad);
    }
    public function update(KeypadRequest $request, string $meeting, string $hall, string $program, string $session, string $id)
    {
        if ($request->validated()) {
            $keypad = Auth::user()->customer->keypads()->findOrFail($id);
            $keypad->session_id = $request->input('session_id');
            $keypad->sort_order = $request->input('sort_order');
            $keypad->keypad = $request->input('keypad');
            if ($keypad->save()) {
                $keypad->updated_by = Auth::user()->id;
                $keypad->save();
                return back()->with('success', __('common.edited-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function destroy(string $meeting, string $hall, string $program, string $session, string $id)
    {
        $keypad = Auth::user()->customer->keypads()->findOrFail($id);
        if ($keypad->delete()) {
            $keypad->deleted_by = Auth::user()->id;
            $keypad->save();
            return back()->with('success', __('common.deleted-successfully'));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }

    public function start_stop_voting(string $meeting, string $hall, string $program, string $session, string $id)
    {
        $session = Auth::user()->customer->programSessions()->findOrFail($session);
        foreach($session->keypads as $keypad){
            if($keypad->id == $id)
                continue;
            $keypad = Auth::user()->customer->keypads()->findOrFail($keypad->id);
            $keypad->on_vote = 0;
            $keypad->save();
        }
        $keypad = Auth::user()->customer->keypads()->findOrFail($id);
        $keypad->on_vote = !$keypad->on_vote;
        if ($keypad->save()) {
            if($keypad->on_vote){
                $keypad->voting_started_at = now()->format('Y-m-d H:i');;
                $keypad->voting_finished_at = null;
                $keypad->save();
                return back()->with('success', __('common.voting-started'));
            }
            else{
                $keypad->voting_finished_at = now()->format('Y-m-d H:i');;
                $keypad->save();
                return back()->with('success', __('common.voting-stopped'));
            }
        } else {
            return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }
}
