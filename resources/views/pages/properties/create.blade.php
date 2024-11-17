@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-left mb-3">
        <h1 class="mb-0 me-auto">New Property</h1>
    </div>
    <form action="" method="post" class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{asset('storage/property_photos/propertynophoto.jpg')}}" alt="property photo" class="card-img-top" style="height: 150px; object-fit:cover;">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="m-0">Property photo</p>
                        <input type="file" name="property_photo" id="txt_property_photo" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <h3 class="m-0 mb-2">Details</h3>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="txt_property_name" class="form-label">Property name<span class="text-danger">*</span></label>
                    <input type="text" name="property_name" id="txt_property_name" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="txt_property_type" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="property_type" id="sel_property_type" class="form-select" required>
                        <option disabled selected>Choose type</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Duplex">Duplex</option>
                        <option value="Single">Single</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="txt_address_street" class="form-label">Street Address<span class="text-danger">*</span></label>
                    <input type="text" name="address_street" id="txt_address_street" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="txt_address_city" class="form-label">City<span class="text-danger">*</span></label>
                    <input name="address_city" list="city_names" id="txt_address_city" class="form-control" required>
                    <datalist id="city_names">
                        <option value="Angeles City"></option>
                        <option value="Apalit"></option>
                        <option value="Arayat"></option>
                        <option value="Bacolor"></option>
                        <option value="Candaba"></option>
                        <option value="Floridablanca"></option>
                        <option value="Guagua"></option>
                        <option value="Lubao"></option>
                        <option value="Mabalacat City"></option>
                        <option value="Macabebe"></option>
                        <option value="Masantol"></option>
                        <option value="Mexico"></option>
                        <option value="Minalin"></option>
                        <option value="Porac"></option>
                        <option value="City of San Fernando"></option>
                        <option value="San Luis"></option>
                        <option value="San Simon"></option>
                        <option value="Santa Ana"></option>
                        <option value="Santa Rita"></option>
                        <option value="Santo Tomas"></option>
                        <option value="Sasmuan"></option>
                    </datalist>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-4">
                <div class="col mb-2">
                    <label for="txt_bedrooms" class="form-label">Bedrooms</label>
                    <input type="number" name="bedrooms" id="txt_bedrooms" class="form-control" min="1">
                </div>
                <div class="col mb-2">
                    <label for="txt_bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" name="bathrooms" id="txt_bathrooms" class="form-control" min="1">
                </div>
                <div class="col mb-2">
                    <label for="txt_floor_area" class="form-label">Floor area</label>
                    <input type="number" name="floor_area" id="txt_floor_area" class="form-control" min="1">
                </div>
                <div class="col mb-3">
                    <label for="txt_land_size" class="form-label">Land size</label>
                    <input type="number" name="land_size" id="txt_land_size" class="form-control" min="1">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{route('property.index')}}" class="btn btn-outline-secondary me-3">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection