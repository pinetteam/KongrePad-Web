<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Meeting\Participant\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function participant(Request $request)
    {
        $participant = Participant::where('username', $request->username)->first();
        if (!$participant) {
            return response([
                'message' => ['The provided credentials are incorrect.']
            ], 500);
        }
        $participant_token = $participant->createToken('api-token')->plainTextToken;
        return response(['token' => $participant_token], 200);
    }
}
