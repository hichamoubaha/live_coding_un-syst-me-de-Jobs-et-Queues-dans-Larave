<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = (object) [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Déclencher le Job
        SendWelcomeEmail::dispatch($user);

        return response()->json(['message' => 'Utilisateur enregistré, email en cours d’envoi.']);
    }
}

