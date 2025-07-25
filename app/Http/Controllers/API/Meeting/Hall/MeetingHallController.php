<?php

namespace App\Http\Controllers\API\Meeting\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Meeting\Document\DocumentResource;
use App\Http\Resources\API\Meeting\Hall\HallResource;
use App\Http\Resources\API\Meeting\Hall\Program\Debate\DebateResource;
use App\Http\Resources\API\Meeting\Hall\Program\Session\Keypad\KeypadResource;
use App\Http\Resources\API\Meeting\Hall\Program\Session\SessionResource;
use App\Http\Traits\ParticipantLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingHallController extends Controller
{
    use ParticipantLog;

    /**
     * Get all halls for the meeting.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $meeting = $request->user()->meeting;
            $this->logParticipantAction($request->user(), "get-halls", __('common.meeting') . ': ' . $meeting->title);

            return response()->json([
                'data' => HallResource::collection($meeting->halls()->get()),
                'status' => true,
                'errors' => null
            ], 200);

        } catch (\Throwable $e) {
            Log::error('MeetingHallController Error (index): ' . $e->getMessage());

            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get a specific hall by its ID.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id)
    {
        try {
            $hall = $request->user()->meeting->halls()->findOrFail($id);
            $this->logParticipantAction($request->user(), "get-hall", $hall->title);

            return response()->json([
                'data' => new HallResource($hall),
                'status' => true,
                'errors' => null
            ], 200);

        } catch (\Throwable $e) {
            Log::error('MeetingHallController Error (show): ' . $e->getMessage());

            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get the active keypad for a specific hall.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active_keypad(Request $request, int $id)
    {
        $meeting_hall = $request->user()->meeting->halls()->findOrFail($id);
        $keypad = $meeting_hall->programSessions()->where('on_air', 1)->first()->keypads()->where('on_vote', 1)->first();
        $result = [];

        if (isset($keypad)) {
            $result['data'] = new KeypadResource($keypad);
            $result['status'] = true;
            $result['errors'] = null;
        } else {
            $result['data'] = null;
            $result['status'] = false;
            $result['errors'] = [__('common.there-is-not-active-keypad')];
        }

        return response()->json($result, 200);
    }

    /**
     * Get the active document for a specific hall.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active_document(Request $request, int $id)
    {
        $meeting_hall = $request->user()->meeting->halls()->findOrFail($id);
        $session = $meeting_hall->programSessions()->where('on_air', 1)->first();
        $result = [];

        $this->logParticipantAction($request->user(), "get-active-document", __('common.hall') . ': ' . $meeting_hall->title);

        if (isset($session)) {
            if (isset($session->document)) {
                $result['data'] = new DocumentResource($session->document);
                $result['status'] = true;
                $result['errors'] = null;
            } else {
                $result['data'] = null;
                $result['status'] = false;
                $result['errors'] = [__('common.there-is-not-any-document')];
            }
        } else {
            $result['data'] = null;
            $result['status'] = false;
            $result['errors'] = [__('common.there-is-not-active-session')];
        }

        return response()->json($result, 200);
    }

    /**
     * Get the active session for a specific hall.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active_session(Request $request, int $id)
    {
        $meeting_hall = $request->user()->meeting->halls()->findOrFail($id);
        $session = $meeting_hall->programSessions()->where('on_air', 1)->first();
        $result = [];

        $this->logParticipantAction($request->user(), "get-active-session", __('common.hall') . ': ' . $meeting_hall->title);

        if (isset($session)) {
            $result['data'] = new SessionResource($session);
            $result['status'] = true;
            $result['errors'] = null;
        } else {
            $result['data'] = null;
            $result['status'] = false;
            $result['errors'] = [__('common.there-is-not-active-session')];
        }

        return response()->json($result, 200);
    }

    public function active_debate(Request $request, int $id)
    {
        $meeting_hall =  $request->user()->meeting->halls()->where("meeting_halls.id", $id)->first();
        $debate = $meeting_hall->debates()->where('on_vote', 1)->first();
        $result = [];
        $this->logParticipantAction($request->user(), "get-active-debate", __('common.hall') . ': ' . $meeting_hall->title);
        if(isset($debate)) {
            $result['data'] = new DebateResource($debate);
            $result['status'] = true;
            $result['errors'] = null;
        }
        else{
            $result['data'] = null;
            $result['status'] = false;
            $result['errors'] = [__('common.there-is-not-active-debate')];
        }
        return $result;
    }

    /**
     * Get all active content for a specific hall.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeContent(Request $request, int $id)
    {
        try {
            $hall = $request->user()->meeting->halls()->findOrFail($id);
            
            // Get active program
            $activeProgram = $hall->programs()->where('is_started', true)->first();
            
            // Get active session
            $activeSession = null;
            if ($activeProgram) {
                $activeSession = $activeProgram->sessions()->where('on_air', true)->first();
            }
            
            // Get active keypad
            $activeKeypad = null;
            if ($activeSession) {
                $activeKeypad = $activeSession->keypads()->where('on_vote', true)->first();
            }
            
            // Get active debate
            $activeDebate = $hall->debates()->where('on_vote', true)->first();
            
            $this->logParticipantAction($request->user(), "get-active-content", __('common.hall') . ': ' . $hall->title);
            
            return response()->json([
                'data' => [
                    'active_program' => $activeProgram ? [
                        'id' => $activeProgram->id,
                        'title' => $activeProgram->title,
                        'is_started' => true
                    ] : null,
                    'active_session' => $activeSession ? [
                        'id' => $activeSession->id,
                        'session_title' => $activeSession->title,
                        'speaker_name' => $activeSession->speaker ? $activeSession->speaker->full_name : null,
                        'document_id' => $activeSession->document_id,
                        'on_air' => true
                    ] : null,
                    'active_keypad' => $activeKeypad ? new KeypadResource($activeKeypad) : null,
                    'active_debate' => $activeDebate ? new DebateResource($activeDebate) : null
                ],
                'status' => true,
                'errors' => null
            ], 200);
            
        } catch (\Throwable $e) {
            Log::error('MeetingHallController Error (activeContent): ' . $e->getMessage());
            
            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }
}
