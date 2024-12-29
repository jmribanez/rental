<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function create(Request $request)
    {
        // include auth cans
        $t = $request->query('t',null);
        $pagefn = 'create';
        $users = User::all();
        return view('pages.users')
            ->with('users', $users)
            ->with('pagefn', $pagefn)
            ->with('t',$t);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // include auth cans
        $validated = $request->validate([
            'name_last' => 'required',
            'name_first' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        $user = new User;
        $user->name_last = $request->name_last;
        $user->name_first = $request->name_first;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->contact_number = $request->contact_number;
        if($request->hasFile('photo_url')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('photo_url');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('user_photos', $newFileName . "." . $extension);
                $user->photo_url = $newFileName . "." . $extension;
            }
        }
        if($request->hasFile('legal_id_photo_url')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('legal_id_photo_url');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('legal_ids', $newFileName . "." . $extension);
                $user->legal_id_photo_url = $newFileName . "." . $extension;
            }
        }
        $user->save();
        $user->assignRole($request->role);
        return to_route('user.show',$user->id)
            ->with('status','success')
            ->with('message','User ' . $user->name_first . ' ' . $user->name_last . ' created.');
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
        // include auth cans
        $validated = $request->validate([
            'name_last' => 'required',
            'name_first' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $user = User::find($id);
        $user->name_last = $request->name_last;
        $user->name_first = $request->name_first;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact_number = $request->contact_number;
        if($request->hasFile('photo_url')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('photo_url');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                // Remove old photo
                Storage::delete('user_photos/'.$user->photo_url);
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('user_photos', $newFileName . "." . $extension);
                $user->photo_url = $newFileName . "." . $extension;
            }
        }
        if($request->hasFile('legal_id_photo_url')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('legal_id_photo_url');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                // Remove old photo
                Storage::delete('legal_ids/'.$user->legal_id_photo_url);
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('legal_ids', $newFileName . "." . $extension);
                $user->legal_id_photo_url = $newFileName . "." . $extension;
            }
        }
        $user->update();
        if($user->getRoleNames()[0] != $request->role) {
            $user->roles()->detach();
            $user->assignRole($request->role);
        }
        return to_route('user.show',$user->id)
            ->with('status','success')
            ->with('message','User ' . $user->name_first . ' ' . $user->name_last . ' updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
