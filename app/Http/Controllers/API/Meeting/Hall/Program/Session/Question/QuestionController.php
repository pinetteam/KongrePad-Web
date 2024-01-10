<?php

namespace App\Http\Controllers\API\Meeting\Hall\Program\Session\Question;

use App\Events\Service\QuestionBoard\QuestionBoardEvent;
use App\Http\Controllers\Controller;
use App\Models\Meeting\Hall\Program\Session\Question\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request, int $hall)
    {
        $meeting_hall = $request->user()->meeting->halls()->findOrFail($hall);
        if ($request->user()->type != "attendee") {
            return [
                'data' => null,
                'status' => false,
                'errors' => ["Soru sorma izniniz yoktur."]
            ];
        }
        $session = $meeting_hall->programSessions()->where('on_air', 1)->first();
        $question = new Question();
        $question->session_id = $session->id;
        $question->questioner_id = $request->user()->id;
        $question->is_hidden_name = $request->input('is_hidden_name');
        $question->question = $request->input('question');
        try{
            $log = new \App\Models\Log\Meeting\Participant\Participant();
            $log->participant_id = $request->user()->id;
            $log->action = "ask-question";
            $log->save();
            return [
                'data' => $question->save() && event(new QuestionBoardEvent($meeting_hall)),
                'status' => true,
                'errors' => null
            ];
        } catch (\Throwable $e){

            return [
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ];
        }
    }
}
