@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-9 mb-3">
            <h3 class="mb-3">Profile</h3>
            <div class="d-flex align-items-center mb-2">
                <img src="{{($selectedUser->photo_url != null)?asset('storage/user_photos/'.$selectedUser->photo_url):asset('storage/user_photos/usernophoto.jpg')}}" alt="user photo" style="width: 70px; height: 70px; object-fit:cover" class="img-thumbnail me-2">
                <div>
                    <h3 class="m-0">{{$selectedUser->name_first . " " . $selectedUser->name_last}}</h3>
                    @if($selectedUser->name_company != null)
                    <p class="m-0">{{$selectedUser->name_company}}</p>
                    @endif
                    <p class="m-0">{{$selectedUser->getRoleNames()[0]}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-2">
                    Username: {{$selectedUser->email}}
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
        </div>
        <div class="col-md-3 mb-3">
            <h3 class="mb-3">&nbsp;</h3>
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{route('user.selfchangepassword')}}" method="POST" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Change password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{($selectedUser->photo_url != null)?asset('storage/user_photos/'.$selectedUser->photo_url):asset('storage/user_photos/usernophoto.jpg')}}" alt="user photo" style="width: 70px; height: 70px; object-fit:cover" class="img-thumbnail me-2">
                        <div>
                            <h5 class="m-0">{{$selectedUser->name_first . " " . $selectedUser->name_last}}</h5>
                            @if($selectedUser->name_company != null)
                            <p class="m-0">{{$selectedUser->name_company}}</p>
                            @endif
                            <p class="m-0">{{$selectedUser->getRoleNames()[0]}} | {{$selectedUser->email}}</p>
                        </div>
                    </div>
                    <input type="hidden" name="userid" value="{{$selectedUser->id}}">
                    <div class="mb-2">
                        <label for="txt_oldpassword" class="form-label">Old password<span class="text-danger">*</span></label>
                        <input type="password" id="txt_oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" name="old_password" required>
                    </div>
                    <div class="mb-2">
                        <label for="txt_password" class="form-label">New password<span class="text-danger">*</span></label>
                        <input type="password" id="txt_password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password') <div class="invalid-feedback">Passwords should match.</div> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="txt_conpassword" class="form-label">Confirm new password<span class="text-danger">*</span></label>
                        <input type="password" id="txt_conpassword" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection