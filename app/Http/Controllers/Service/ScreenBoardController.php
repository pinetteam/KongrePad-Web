<?php

namespace App\Http\Controllers\Service;

use App\Events\Service\Screen\ChairEvent;
use App\Events\Service\Screen\KeypadEvent;
use App\Events\Service\Screen\SpeakerEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ScreenBoard\ChairScreenRequest;
use App\Http\Requests\Service\ScreenBoard\KeypadScreenRequest;
use App\Http\Requests\Service\ScreenBoard\SpeakerScreenRequest;
use App\Models\Meeting\Hall\Hall;
use App\Models\Meeting\Hall\Screen\Screen;

class ScreenBoardController extends Controller
{
    public function index(string $code)
    {
        $hall = Hall::where('code', $code)->first();
        $meeting = $hall->meeting;
        $participants = $meeting->participants;
        $screens = $hall->screens()->get();
        $keypads = $meeting->keypads()->get();
        return view('service.screen-board.index', compact(['hall', 'participants', 'screens', 'keypads']));
    }
    public function speaker_screen(SpeakerScreenRequest $request, string $code)
    {
        if ($request->validated()) {
            $screen = Screen::where('code', $code)->first();
            $hall = $screen->hall;
            $meeting = $hall->meeting;
            $participants = $meeting->participants;
            $screens = $hall->screens()->get();
            $participant = null;
            $keypads = $meeting->keypads()->get();
            if ($request->input('speaker_id') != null) {
                $participant = $meeting->participants()->findOrFail($request->input('speaker_id'));
            }
            event(new SpeakerEvent($screen, $participant));
            return view('service.screen-board.index', compact(['hall', 'participants', 'screens', 'keypads']));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'));
        }
    }
    public function chair_screen(ChairScreenRequest $request, string $code)
    {
        if ($request->validated()) {
            $screen = Screen::where('code', $code)->first();
            $hall = $screen->hall;
            $meeting = $hall->meeting;
            $participants = $meeting->participants;
            $screens = $hall->screens()->get();
            $participant = null;
            $keypads = $meeting->keypads()->get();
            if ($request->input('chair_id') != null) {
                $participant = $meeting->participants()->findOrFail($request->input('chair_id'));
            }
            event(new ChairEvent($screen, $participant));
            return view('service.screen-board.index', compact(['hall', 'participants', 'screens', 'keypads']));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'));
        }
    }
    public function keypad_screen(KeypadScreenRequest $request, string $code)
    {
        if ($request->validated()) {
            $screen = Screen::where('code', $code)->first();
            $hall = $screen->hall;
            $meeting = $hall->meeting;
            $participants = $meeting->participants;
            $screens = $hall->screens()->get();
            $keypad = null;
            $keypads = $meeting->keypads()->get();
            if ($request->input('keypad_id') != null) {
                $keypad = $meeting->keypads()
                    ->withCount('votes')
                    ->with(['options' => function($query) {
                        $query->withCount('votes');
                    }])
                    ->findOrFail($request->input('keypad_id'));
            }
            event(new KeypadEvent($screen, $keypad));
            return view('service.screen-board.index', compact(['hall', 'participants', 'screens', 'keypads']));
        } else {
            return back()->with('error', __('common.a-system-error-has-occurred'));
        }
    }
}
