<?php

namespace App\Http\Controllers;

use App\User;
use Gerardojbaez\Messenger\Facades\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function home() {
        return view('home');
    }
}
