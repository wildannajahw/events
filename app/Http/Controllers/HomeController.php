<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = \App\Event::inRandomOrder()->paginate(4);
        $articles = \App\Article::inRandomOrder()->paginate(3);
        $cobas1 = \App\Event::inRandomOrder()->paginate(1);
        $cobas2 = \App\Event::inRandomOrder()->paginate(1);
        $cobas3 = \App\Event::inRandomOrder()->paginate(1);
        return view('welcome', ['articles' => $articles, 'events' => $events, 'cobas1' => $cobas1, 'cobas2' => $cobas2, 'cobas3' => $cobas3]);
    }
}
