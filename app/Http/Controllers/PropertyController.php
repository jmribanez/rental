<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
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
        $properties = Property::all();
        return view('pages.properties.index')
            ->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_name' => 'required',
            'property_type' => 'required',
            'address_street' => 'required',
            'address_city' => 'required',
        ]);
        $property = new Property;
        $property->name = $request->property_name;
        $property->type = $request->property_type;
        $property->address_street = $request->address_street;
        $property->address_city = $request->address_city;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->floor_area = $request->floor_area;
        $property->land_size = $request->land_size;
        if($request->hasFile('property_photo')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('property_photo');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('property_photos', $newFileName . "." . $extension);
                $property->property_photo = $newFileName . "." . $extension;
            }
        }
        $property->save();
        return to_route('property.show',$property->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // include auth can
        $property = Property::find($id);
        return view('pages.properties.show')
            ->with('property', $property);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::find($id);
        return view('pages.properties.edit')
            ->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'property_name' => 'required',
            'property_type' => 'required',
            'address_street' => 'required',
            'address_city' => 'required',
        ]);
        $property = Property::find($id);
        $property->name = $request->property_name;
        $property->type = $request->property_type;
        $property->address_street = $request->address_street;
        $property->address_city = $request->address_city;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->floor_area = $request->floor_area;
        $property->land_size = $request->land_size;
        if($request->hasFile('property_photo')) {
            $allowedFileExtension = ['jpg','jpeg','png'];
            $file = $request->file('property_photo');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                // Remove old photo
                Storage::delete('property_photos/'.$property->photo_url);
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('property_photos', $newFileName . "." . $extension);
                $property->property_photo = $newFileName . "." . $extension;
            }
        }
        $property->update();
        return to_route('property.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
