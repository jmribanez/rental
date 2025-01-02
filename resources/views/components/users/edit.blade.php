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
                <input type="email" id="txt_email" class="form-control" name="email" value="{{$selectedUser->email}}" required>
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
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="txt_photo_url" class="form-label">Change user photo</label>
                <input type="file" name="photo_url" id="txt_photo_url" class="form-control">
            </div>
            <div class="col-md-6 mb-2">
                <label for="txt_legal_id" class="form-label">Change legal ID</label>
                <input type="file" name="legal_id_photo_url" id="txt_legal_id" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col d-flex">
                <a href="{{route('user.index')}}" class="btn btn-outline-secondary me-auto">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>