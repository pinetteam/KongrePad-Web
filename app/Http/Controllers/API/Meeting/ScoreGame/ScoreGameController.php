<?php

namespace App\Http\Controllers\API\Meeting\ScoreGame;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Meeting\ScoreGame\ScoreGameResource;
use App\Http\Traits\ParticipantLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScoreGameController extends Controller
{
    use ParticipantLog;
    public function index(Request $request)
    {
        App::setLocale('tr');
        try{
            $meeting = $request->user()->meeting;
            $this->logParticipantAction($request->user(), "get-score-games", __('common.meeting') . ': ' . $meeting->title);
            return [
                'data' => new ScoreGameResource($meeting->scoreGames()->first()),
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
    
    public function show(Request $request, int $score_game_id)
    {
        App::setLocale('tr');
        try{
            $meeting = $request->user()->meeting;
            $scoreGame = $meeting->scoreGames()->findOrFail($score_game_id);
            $this->logParticipantAction($request->user(), "get-score-game", __('common.score-game') . ': ' . $scoreGame->title);
            return [
                'data' => new ScoreGameResource($scoreGame),
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

