@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Create Venue
    </div>
    <div class="card-body">
        <form action="{{route('venue.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name"><span class="text-danger">*</span> Name</label>
            <input type="input" class="form-control" id="name" name="name" placeholder="Enter Name">
            <label for="input"><span class="text-danger">*</span> Address</label>
            <input type="input" class="form-control" id="name" name="address" placeholder="Enter Name">
            <label for="name"><span class="text-danger">*</span> Contact Number</label>
            <input type="tel" class="form-control" id="name" name="contact_number" placeholder="Enter Name">
            @foreach ($errors->all() as $error) 
                <small id="emailHelp" class="form-text text-danger">{{ $error }}</small>
            @endforeach
        </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
@endsection