<div>
    <h3 class="m-0">{{$selectedUtility->name}}</h3>
    <p class="m-0 text-secondary">{{$selectedUtility->type}}</p>
    @if($selectedUtility->address != null || $selectedUtility->contact_number)
    <div class="d-flex justify-content-between align-items-center mt-1">
        <div>{!!$selectedUtility->address??'<em class="text-secondary">No address set</em>'!!}</div>
        <div>{!!$selectedUtility->contact_number??'<em class="text-secondary">No contact number set</em>'!!}</div>
    </div>
    @endif
    <p class="m-0 fw-bold mt-3">Subscribed Households</p>
    <ul class="list-group list-group-flush">
        @if(count($selectedUtility->properties)>0)
        @foreach ($selectedUtility->properties as $pu)
        <a href="{{route('property.show',$pu->id)}}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between"><span>{{$pu->name}}</span><span>{{$pu->pivot->account_number}}</span></a>
        @endforeach
        
        @else
        <li class="list-group-item"><em>No households subscribed.</em></li>
        @endif
    </ul>
    
    <div class="d-flex mt-3">
        <a href="{{route('utility.index')}}" class="btn btn-outline-secondary">Cancel</a>
        <a href="{{route('utility.edit',$selectedUtility->id)}}" class="btn btn-secondary ms-auto">Edit</a>
    </div>
</div>