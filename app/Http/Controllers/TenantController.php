<?php

namespace App\Http\Controllers;

use App\Models\Contract;
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
        $pagefn = 'index';
        $tenants = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tenant');
        }, 1)->get();
        $user = null;
        return view('pages.tenants')
            ->with('pagefn', $pagefn)
            ->with('tenants',$tenants)
            ->with('selectedTenant', $user);
    }

    public function show(string $id) {
        $pagefn = 'show';
        $tenants = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tenant');
        }, 1)->get();
        $user = User::find($id);
        return view('pages.tenants')
            ->with('pagefn', $pagefn)
            ->with('tenants',$tenants)
            ->with('selectedTenant', $user);
    }

    public function listContracts(string $id) {
        $pagefn = 'contracts';
        $tenants = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tenant');
        }, 1)->get();
        $user = User::find($id);
        return view('pages.tenants')
            ->with('pagefn', $pagefn)
            ->with('tenants',$tenants)
            ->with('selectedTenant', $user);
    }
}
