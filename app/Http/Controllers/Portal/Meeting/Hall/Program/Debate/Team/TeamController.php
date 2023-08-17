<?php

namespace App\Http\Controllers\Portal\Meeting\Hall\Program\Debate\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Meeting\Hall\Program\Debate\Team\TeamRequest;
use App\Http\Resources\Portal\Meeting\Hall\Program\Debate\Team\TeamResource;
use App\Models\Meeting\Hall\Program\Debate\Team\Team;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function store(TeamRequest $request)
    {
        if ($request->validated()) {
            $team = new Team();
            $team->sort_order = $request->input('sort_order');
            $team->debate_id = $request->input('debate_id');
            $team->code = $request->input('code');
            if ($request->has('logo')) {
                $logo = Image::make($request->file('logo'))->encode('data-url');
                $team->logo = $logo;
            }
            $team->title = $request->input('title');
            $team->description = $request->input('description');
            if ($team->save()) {
                $team->created_by = Auth::user()->id;
                $team->save();
                return back()->with('success', __('common.created-successfully'));
            } else {
                return back()->with('create_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function show(int $meeting, int $hall, int $program, int $debate, int $id)
    {
        $team = Auth::user()->customer->teams()->findOrFail($id);
        return view('portal.meeting.hall.program.debate.team.show', compact(['team']));
    }
    public function edit(int $meeting, int $hall, int $program, int $debate, int $id)
    {
        $team = Auth::user()->customer->teams()->findOrFail($id);
        return new TeamResource($team);
    }
    public function update(TeamRequest $request,int $meeting, int $hall, int $program, int $debate,  int $id)
    {
        if ($request->validated()) {
            $team = Auth::user()->customer->teams()->findOrFail($id);
            $team->sort_order = $request->input('sort_order');
            $team->debate_id = $request->input('debate_id');
            $team->code = $request->input('code');
            if ($request->has('logo')) {
                $logo = Image::make($request->file('logo'))->encode('data-url');
                $team->logo = $logo;
            }
            $team->title = $request->input('title');
            $team->description = $request->input('description');
            if ($team->save()) {
                $team->updated_by = Auth::user()->id;
                $team->save();
                return back()->with('success', __('common.edited-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function destroy(int $meeting, int $hall, int $program, int $debate, int $id)
    {
        $team = Auth::user()->customer->teams()->findOrFail($id);
        if ($team->delete()) {
            $team->deleted_by = Auth::user()->id;
            $team->save();
            return back()->with('success', __('common.deleted-successfully'));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }
}
