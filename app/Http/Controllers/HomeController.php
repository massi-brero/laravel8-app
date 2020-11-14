<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $hobbies = Hobby::where('user_id', auth()->id())
                     ->orderBy('updated_at', 'DESC')
                     ->get();

        return view('home')->with([
            'hobbies' => $hobbies,
            'meldg_success' => Session::get('meldg_success')
        ]);
    }
}
