<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\EmptyInput;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'username' => [new EmptyInput, 'string'],
            'password' => [new EmptyInput],
        ]);

        // Grab password from database
        $user = User::where('username', strtolower($request->username))->first();

        if (!is_null($user)) {
            // Compare given password with stored one
            $storedPassword = $user->password;

            if(password_verify($request->password, $storedPassword)) {
                // On success, create session
                session_start();
                $_SESSION["userId"] = $user->id;
                $_SESSION["username"] = $user->display_username;
                return redirect()->route('dashboard');
            }
            else {
                // Redirect user
                return redirect()->route('login')->with('status', 'wrong-credentials');
            }

        } else {
            return redirect()->route('login')->with('status', 'user-not-found');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        session_start();
        session_unset();
        session_destroy();

        return redirect()->route('dashboard');
    }
}
