<?php

namespace App\Http\Controllers\API\Meeting\Hall\Program\Session\Keypad\Vote;

use App\Http\Controllers\Controller;
use App\Models\Meeting\Hall\Program\Session\Keypad\Vote\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, int $keypad){

            $vote = new Vote();
            $vote->option_id = $request->input('option');
            $vote->participant_id = $request->user()->id;
            $vote->keypad_id = $keypad;
            try{
                $vote->save();
                return [
                    'data' => null,
                    'status' => true,
                    'errors' => null
                ];
            } catch (\Throwable $e){
                return [
                    'data' => null,
                    'status' => false,
                    'errors' => ['error']
                ];
            }
        }
}

