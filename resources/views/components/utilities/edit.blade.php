<div>
    <form action="{{route('utility.update',$selectedUtility->id)}}" method="post">
        @csrf
        @method('PATCH')
        <h3>Edit utility</h3>
        <div class="row">
            <div class="col-6 mb-2">
                <label for="txt_utility_name" class="form-label">Service provider name<span class="text-danger">*</span></label>
                <input type="text" name="utility_name" id="txt_utility_name" class="form-control" value="{{$selectedUtility->name}}" required>
            </div>
            <div class="col-6 mb-2">
                <label for="sel_utility_type" class="form-label">Type<span class="text-danger">*</span></label>
                <select name="utility_type" id="sel_utility_type" class="form-select" required>
                    <option value="Electric" {{($selectedUtility->type=='Electric')?'selected':''}}>Electric</option>
                    <option value="Water" {{($selectedUtility->type=='Water')?'selected':''}}>Water</option>
                    <option value="Telephone" {{($selectedUtility->type=='Telephone')?'selected':''}}>Telephone</option>
                    <option value="Internet" {{($selectedUtility->type=='Internet')?'selected':''}}>Internet</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-2">
                <label for="txt_utility_address" class="form-label">Address</label>
                <input type="text" name="utility_address" id="txt_utility_address" class="form-control" value="{{$selectedUtility->address}}">
            </div>
            <div class="col-6 mb-2">
                <label for="txt_utility_contact" class="form-label">Contact number</label>
                <input type="text" name="utility_contact" id="txt_utility_contact" class="form-control" value="{{$selectedUtility->contact_number}}">
            </div>
        </div>
        <div class="d-flex mt-3">
            <a href="{{route('utility.show',$selectedUtility->id)}}" class="btn btn-outline-secondary">Cancel</a>
            <input type="submit" value="Save" class="btn btn-primary ms-auto">
        </div>
    </form>
</div>