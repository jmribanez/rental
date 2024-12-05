<?php

namespace App\Http\Controllers;

use App\Models\Contract;
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
            case 'Landlord':
                return view('pages.home.admin');
                break;
            case 'Staff':
                return view('pages.home.staff');
                break;
            default:
                $contract = Contract::where('user_id',Auth::user()->id)->get();
                return view('pages.home.tenant')
                    ->with('contract',$contract);
                break;
        }
        return view('regularhome');
    }
}
