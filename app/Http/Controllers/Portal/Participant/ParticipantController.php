<?php

namespace App\Http\Controllers\Portal\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Participant\ParticipantRequest;
use App\Http\Resources\Portal\Participant\ParticipantResource;
use App\Models\Participant\Participant;
use App\Models\System\Country\SystemCountry;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Auth::user()->customer->participants()->paginate(20);
        $meetings = Auth::user()->customer->meetings()->where('status', 1)->get();
        $phone_countries = SystemCountry::get();
        $types = [
            'agent' => ["value" => "agent", "title" => __('common.agent')],
            'attendee' => ["value" => "attendee", "title" => __('common.attendee')],
            'team' => ["value" => "team", "title" => __('common.team')],
        ];
        $confirmations = [
            'not-approved' => ["value" => 0, "title" => __('common.not-approved'), 'color' => 'danger'],
            'approved' => ["value" => 1, "title" => __('common.approved'), 'color' => 'success'],
        ];
        $statuses = [
            'active' => ["value" => 0, "title" => __('common.passive'), 'color' => 'danger'],
            'passive' => ["value" => 1, "title" => __('common.active'), 'color' => 'success'],
        ];
        return view('portal.participant.index', compact(['participants', 'meetings', 'phone_countries', 'types', 'confirmations', 'statuses']));
    }
    public function store(ParticipantRequest $request)
    {
        if ($request->validated()) {
            $participant = new Participant();
            $participant->meeting_id = $request->input('meeting_id');
            $participant->username = $request->input('username');
            $participant->title = $request->input('title');
            $participant->first_name = $request->input('first_name');
            $participant->last_name = $request->input('last_name');
            $participant->organisation = $request->input('organisation');
            $participant->identification_number = $request->input('identification_number');
            $participant->email = $request->input('email');
            $participant->phone_country_id = $request->input('phone_country_id');
            $participant->phone = $request->input('phone');
            $participant->password = $request->input('password');
            $participant->type = $request->input('type');
            $participant->confirmation = $request->input('confirmation');
            $participant->status = $request->input('status');
            if ($participant->save()) {
                return back()->with('success', __('common.created-successfully'));
            } else {
                return back()->with('create_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $participant = Auth::user()->customer->participants()->findOrFail($id);
        return new ParticipantResource($participant);
    }
    public function update(ParticipantRequest $request, string $id)
    {
        if ($request->validated()) {
            $participant = Auth::user()->customer->participants()->findOrFail($id);
            $participant->meeting_id = $request->input('meeting_id');
            $participant->username = $request->input('username');
            $participant->title = $request->input('title');
            $participant->first_name = $request->input('first_name');
            $participant->last_name = $request->input('last_name');
            $participant->organisation = $request->input('organisation');
            $participant->identification_number = $request->input('identification_number');
            $participant->email = $request->input('email');
            $participant->phone_country_id = $request->input('phone_country_id');
            $participant->phone = $request->input('phone');
            if ($request->has('password')) {
                $participant->password = $request->input('password');
            }
            $participant->confirmation = $request->input('confirmation');
            $participant->status = $request->input('status');
            if ($participant->save()) {
                return back()->with('success',__('common.edited-successfully'));
            } else {
                return back()->with('edit_modal', true)->with('error', __('common.a-system-error-has-occurred'))->withInput();
            }
        }
    }
    public function destroy(string $id)
    {
        $participant = Auth::user()->customer->participants()->findOrFail($id);
        if ($participant->delete()) {
            $participant->deleted_by = Auth::user()->id;
            $participant->save();
            return back()->with('success', __('common.deleted-successfully'));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'))->withInput();
        }
    }
}
