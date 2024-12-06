<div>
    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Add user</h3>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_name_last" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_last" class="form-control" name="name_last" value="{{old('name_last')}}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_name_first" class="form-label">First Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_first" class="form-control" name="name_first" value="{{old('name_first')}}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" id="txt_email" class="form-control" name="email" value="{{old('email')}}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="sel_role" class="form-label">Role<span class="text-danger">*</span></label>
                <select name="role" id="sel_role" class="form-select">
                    <option disabled {{(old('role')==null)?'selected':''}}>Choose a role</option>
                    <option value="Administrator" {{(old('role')=='Administrator')?'selected':''}}>Administrator</option>
                    <option value="Landlord" {{(old('role')=='Landlord')?'selected':''}}>Landlord</option>
                    <option value="Staff" {{(old('role')=='Staff')?'selected':''}}>Staff</option>
                    <option value="Tenant" {{(old('role')=='Tenant' || $isTenant)?'selected':''}}>Tenant</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_password" class="form-label">Password<span class="text-danger">*</span></label>
                <input type="password" id="txt_password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password') <div class="invalid-feedback">Passwords should match.</div> @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_conpassword" class="form-label">Confirm password<span class="text-danger">*</span></label>
                <input type="password" id="txt_conpassword" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <label for="txt_address" class="form-label">Address</label>
                <input type="text" name="address" id="txt_address" class="form-control" value={{old('address')}}>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_contact_number" class="form-label">Contact Number</label>
                <input type="text" name="contact_number" id="txt_contact_number" class="form-control" value="{{old('contact_number')}}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_photo_url" class="form-label">User photo</label>
                <input type="file" name="photo_url" id="txt_photo_url" class="form-control">
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_legal_id" class="form-label">Legal ID</label>
                <input type="file" name="legal_id_photo_url" id="txt_legal_id" class="form-control">
            </div>
        </div> --}}
        <div class="row">
            <div class="col d-flex mt-3">
                <a href="{{route('user.index')}}" class="btn btn-outline-secondary me-auto">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>