@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-left mb-3">
        <h1 class="mb-0 me-auto">Edit Property</h1>
    </div>
    <form action="{{route('property.update',$property->id)}}" method="post" class="row" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{($property->photo_url != null)?asset('storage/property_photos/'.$property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" alt="property photo" class="card-img-top" style="height: 150px; object-fit:cover;">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="m-0">Set new property photo</p>
                        <input type="file" name="property_photo" id="txt_property_photo" class="form-control">
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="fw-bold m-0 me-auto">Utilities</p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddUtility" class="small link-underline link-underline-opacity-0"><i class="fa-solid fa-plus"></i> Add</a>
                    </div>
                    @if(count($property->utilities)>0)
                        <ul class="list-group list-group-flush">
                        @foreach ($property->utilities as $pk => $pu)
                        <li class="list-group-item d-flex">
                            <a href="{{route('utility.show',$pu->id)}}" class="text-decoration-none text-dark">{{$pu->name}}</a>
                            <span class="ms-auto">{{$pu->pivot->account_number}}</span>
                            <a href="#" class="btn btn-sm btn-link text-danger ms-2 p-0" data-bs-toggle="modal" data-bs-target="#{{'modalRemoveUtility'.$pk}}" ><i class="fa-solid fa-xmark"></i></a>
                        </li>
                        @endforeach
                        </ul>
                    @else
                        <p class="m-0"><em>No utilities added.</em></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <h3 class="m-0 mb-2">Details</h3>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="txt_property_name" class="form-label">Property name<span class="text-danger">*</span></label>
                    <input type="text" name="property_name" id="txt_property_name" class="form-control" value="{{$property->name}}" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="txt_property_type" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="property_type" id="sel_property_type" class="form-select" required>
                        <option value="Apartment" {{($property->type =='Apartment')?'selected':''}}>Apartment</option>
                        <option value="Duplex" {{($property->type =='Duplex')?'selected':''}}>Duplex</option>
                        <option value="Single" {{($property->type =='Single')?'selected':''}}>Single</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label for="txt_address_street" class="form-label">Street Address<span class="text-danger">*</span></label>
                    <input type="text" name="address_street" id="txt_address_street" class="form-control" value="{{$property->address_street}}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="txt_address_city" class="form-label">City<span class="text-danger">*</span></label>
                    <input name="address_city" list="city_names" id="txt_address_city" class="form-control" value="{{$property->address_city}}" required>
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
                    <input type="number" name="bedrooms" id="txt_bedrooms" class="form-control" min="1" value="{{$property->bedrooms}}">
                </div>
                <div class="col mb-2">
                    <label for="txt_bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" name="bathrooms" id="txt_bathrooms" class="form-control" min="1" value="{{$property->bathrooms}}">
                </div>
                <div class="col mb-2">
                    <label for="txt_floor_area" class="form-label">Floor area</label>
                    <input type="number" name="floor_area" id="txt_floor_area" class="form-control" min="1" value="{{$property->floor_area}}">
                </div>
                <div class="col mb-3">
                    <label for="txt_land_size" class="form-label">Land size</label>
                    <input type="number" name="land_size" id="txt_land_size" class="form-control" min="1" value="{{$property->land_size}}">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{route('property.index')}}" class="btn btn-outline-secondary me-3">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <div id="modalAddUtility" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{route('property.setUtility',$property->id)}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Utility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="sel_utility_id" class="form-label">Utility provider</label>
                        <select name="utility_id" id="sel_utility_id" class="form-select">
                            @foreach ($available_utilities as $a_u)
                            <option value="{{$a_u->id}}">{{$a_u->type}} - {{$a_u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="txt_account_number" class="form-label">Account number</label>
                        <input type="text" name="account_number" id="txt_account_number" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    @foreach ($property->utilities as $pk => $pu)
    <div class="modal fade" tabindex="-1" id="{{'modalRemoveUtility'.$pk}}">
        <div class="modal-dialog">
            <form action="{{route('property.unsetUtility',$property->id)}}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Remove Utility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove the utility {{$pu->name}}  with account number {{$pu->pivot->account_number}} from the property {{$property->name}}?</p>
                    <p>This action cannot be undone.</p>
                    <input type="hidden" name="utility_id" value="{{$pu->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Remove" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
    
    @endforeach
@endsection