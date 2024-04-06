<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\BreachPassword;
use App\Rules\EmptyInput;
use App\Rules\MaxLength;
use App\Rules\MinLength;
use App\Rules\SequentialChars;
use App\Rules\SwearWords;
use App\Rules\UniqueUsername;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Rules\Validcharacters;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse    
    {
        
        $request->validate([
            'username' => [new EmptyInput, new UniqueUsername, new Validcharacters, new SwearWords],            
            'password' => [new EmptyInput, new MinLength, new MaxLength, new SequentialChars, new BreachPassword],
        ]);   

        $user = User::create([
            'username' => strtolower($request->username),
            'display_username' => $request->username,
            'password' => Hash::make($request->password),            
        ]);

        return redirect()->route('login')->with('status', 'user-registred');
    }
}
