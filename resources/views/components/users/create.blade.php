<div>
    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
        <h3>Add user</h3>
        <div class="row mb-2">
            <div class="col-md-6">
                <label for="txt_name_last" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_last" class="form-control" name="name_last" required>
            </div>
            <div class="col-md-6">
                <label for="txt_name_first" class="form-label">First Name<span class="text-danger">*</span></label>
                <input type="text" id="txt_name_first" class="form-control" name="name_first" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label for="txt_email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" id="txt_email" class="form-control" name="email" required>
            </div>
            <div class="col-md-6">
                <label for="sel_role" class="form-label">Role<span class="text-danger">*</span></label>
                <select name="role" id="sel_role" class="form-select">
                    <option disabled selected>Choose a role</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Landlord">Landlord</option>
                    <option value="Cashier">Cashier</option>
                    <option value="Tenant">Tenant</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label for="txt_password" class="form-label">Password<span class="text-danger">*</span></label>
                <input type="password" id="txt_password" class="form-control" name="password" required>
            </div>
            <div class="col-md-6">
                <label for="txt_conpassword" class="form-label">Confirm password<span class="text-danger">*</span></label>
                <input type="password" id="txt_conpassword" class="form-control" name="confirmpassword" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="txt_address" class="form-label">Address</label>
                <input type="text" name="address" id="txt_address" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="txt_photo_url" class="form-label">User photo</label>
                <input type="file" name="photo_url" id="txt_photo_url" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="txt_legal_id" class="form-label">Legal ID</label>
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