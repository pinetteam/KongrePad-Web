<?php

namespace App\Http\Controllers\Portal\Report\ScoreGame;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ScoreGameController extends Controller
{
    public function index()
    {
        $score_games = Auth::user()->customer->scoreGames()->paginate(20);
        return view('portal.report.score-game.index', compact(['score_games']));
    }
    public function show(int $id)
    {
        $score_game = Auth::user()->customer->scoreGames()->findOrFail($id);
        $participants = $score_game->meeting->participants;
        $sortedParticipants = $participants->sortByDesc(function ($participant) use ($score_game) {
            return $participant->getTotalScoreGamePoint($score_game->id);
        });
        $page = request('page', 1);
        $perPage = 15;

        $currentPageItems = $sortedParticipants->slice(($page - 1) * $perPage, $perPage)->all();
        $participants = new LengthAwarePaginator($currentPageItems, count($sortedParticipants), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        return view('portal.report.score-game.show', compact(['score_game', 'participants']));
    }
}
