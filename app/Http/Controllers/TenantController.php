<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TenantController extends Controller
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

    public function index() {

    }

    public function show(User $user) {
        
    }
}
