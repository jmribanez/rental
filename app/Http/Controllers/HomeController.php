<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userRole = Auth::user()->getRoleNames()[0];
        switch($userRole) {
            case 'Administrator':
                return view('pages.home.admin');
                break;
            case 'Staff':
                return view('pages.home.staff');
                break;
            default:
                return view('pages.home.tenant');
                break;
        }
        return view('regularhome');
    }
}
