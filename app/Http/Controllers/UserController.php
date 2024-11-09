<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->can('list users')) {
            abort(403);
        }
        $pagefn = 'index';
        $users = User::all();
        return view('pages.users')
            ->with('users', $users)
            ->with('pagefn', $pagefn);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pagefn = 'create';
        $users = User::all();
        return view('pages.users')
            ->with('users', $users)
            ->with('pagefn', $pagefn);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pagefn = 'show';
        $users = User::all();
        $selectedUser = User::find($id);
        return view('pages.users')
            ->with('users', $users)
            ->with('pagefn', $pagefn)
            ->with('selectedUser', $selectedUser);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pagefn = 'edit';
        $users = User::all();
        $selectedUser = User::find($id);
        return view('pages.users')
            ->with('users', $users)
            ->with('pagefn', $pagefn)
            ->with('selectedUser', $selectedUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
