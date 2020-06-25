<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $user=User::first();
        return view('welcome',compact('user'));
    }
}
