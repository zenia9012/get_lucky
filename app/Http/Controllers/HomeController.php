<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeRequest $request)
    {
        return view('dashboard');
    }
}
