<div>
    <form action="{{route('user.update',$selectedUser->id)}}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <h3>Edit user</h3>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_name_last" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_last" class="form-control" name="name_last" value="{{$selectedUser->name_last}}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_name_first" class="form-label">First Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_first" class="form-control" name="name_first" value="{{$selectedUser->name_first}}" required>
            </div>
        </div>
        <div class="mb-2">
            <label for="txt_name_company" class="form-label">Company Name</label>
            <input type="text" name="name_company" id="txt_name_company" class="form-control" value="{{$selectedUser->name_company}}">
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_email" class="form-label">Username<span class="text-danger">*</span></label>
                <input type="text" id="txt_email" class="form-control" name="email" value="{{$selectedUser->email}}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="sel_role" class="form-label">Role<span class="text-danger">*</span></label>
                <select name="role" id="sel_role" class="form-select">
                    <option value="Administrator" {{($selectedUser->getRoleNames()[0]=='Administrator')?'selected':''}}>Administrator</option>
                    <option value="Landlord" {{($selectedUser->getRoleNames()[0]=='Landlord')?'selected':''}}>Landlord</option>
                    <option value="Staff" {{($selectedUser->getRoleNames()[0]=='Staff')?'selected':''}}>Staff</option>
                    <option value="Tenant" {{($selectedUser->getRoleNames()[0]=='Tenant')?'selected':''}}>Tenant</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <label for="txt_address" class="form-label">Address</label>
                <input type="text" name="address" id="txt_address" class="form-control" value="{{$selectedUser->address}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_contact_number" class="form-label">Contact number</label>
                <input type="text" id="txt_contact_number" class="form-control" name="contact_number">
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_photo_url" class="form-label">Change user photo</label>
                <input type="file" name="photo_url" id="txt_photo_url" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col d-flex mt-3">
                <a href="{{route('user.index')}}" class="btn btn-sm btn-outline-secondary me-auto">Cancel</a>
                <button type="button" class="btn btn-sm btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                <input type="submit" value="Save" class="btn btn-sm btn-primary">
            </div>
        </div>
    </form>
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{route('user.changepassword',$selectedUser->id)}}" method="POST" class="modal-content">
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
</div>