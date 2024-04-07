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
        $user = User::where('username', strtolower($request->username))->get();

        // Compare given password with stored one
        $storedPassword = $user[0]->password;

        if(password_verify($request->password, $storedPassword)){
            // On success, create session
            session_start();
            $_SESSION["userId"] = $user[0]->id;
            $_SESSION["username"] = $user[0]->display_username;
            return redirect()->route('dashboard');
        }
        else {
            // Redirect user
            return redirect()->route('login')->with('status', 'wrong-credentials');
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
