<div>
    <div class="d-flex align-items-center mb-2">
        <img src="{{($selectedUser->photo_url != null)?asset('storage/user_photos/'.$selectedUser->photo_url):asset('storage/user_photos/usernophoto.jpg')}}" alt="user photo" style="width: 70px; height: 70px; object-fit:cover" class="img-thumbnail me-2">
        <div>
            <h3 class="m-0">{{$selectedUser->name_first . " " . $selectedUser->name_last}}</h3>
            <p class="m-0">{{$selectedUser->getRoleNames()[0]}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-2">
            Email: {{$selectedUser->email}}
        </div>
        <div class="col-6 mb-2">
            Contact Number: {!!$selectedUser->contact_number??'<em>Not set</em>'!!}
        </div>
    </div>
    <div class="row">
        <div class="col mb-2">
            Address: {!!$selectedUser->address??'<em>Not set</em>'!!}
        </div>
    </div>
    <div class="d-flex">
        <a href="{{route('user.index')}}" class="btn btn-outline-secondary me-auto">Cancel</a>
        <a href="{{route('user.edit',$selectedUser->id)}}" class="btn btn-secondary">Edit</a>
    </div>
</div>