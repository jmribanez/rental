<?php

namespace App\Http\Controllers;

use App\Models\Utility;
use Illuminate\Http\Request;

class UtilityController extends Controller
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
        $pagefn = 'index';
        $utilities = Utility::all();
        return view('pages.utilities')
            ->with('utilities', $utilities)
            ->with('pagefn', $pagefn);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // include auth cans
        $pagefn = 'create';
        $utilities = Utility::all();
        return view('pages.utilities')
            ->with('utilities', $utilities)
            ->with('pagefn', $pagefn);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'utility_name' => 'required',
            'utility_type' => 'required',
        ]);
        $utility = new Utility;
        $utility->name = $request->utility_name;
        $utility->type = $request->utility_type;
        $utility->address = $request->utility_address;
        $utility->contact_number = $request->utility_contact;
        $utility->save();
        return to_route('utility.show',$utility->id)
            ->with('status','success')
            ->with('message','Utility ' . $utility->name . ' created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pagefn = 'show';
        $utilities = Utility::all();
        $selectedUtility = Utility::find($id);
        return view('pages.utilities')
            ->with('utilities', $utilities)
            ->with('pagefn', $pagefn)
            ->with('selectedUtility', $selectedUtility);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pagefn = 'edit';
        $utilities = Utility::all();
        $selectedUtility = Utility::find($id);
        return view('pages.utilities')
            ->with('utilities', $utilities)
            ->with('pagefn', $pagefn)
            ->with('selectedUtility', $selectedUtility);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'utility_name' => 'required',
            'utility_type' => 'required',
        ]);
        $utility = Utility::find($id);
        $utility->name = $request->utility_name;
        $utility->type = $request->utility_type;
        $utility->address = $request->utility_address;
        $utility->contact_number = $request->utility_contact;
        $utility->update();
        return to_route('utility.show', $id)
            ->with('status','success')
            ->with('message','Utility ' . $utility->name . ' updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utility $utility)
    {
        //
    }
}
