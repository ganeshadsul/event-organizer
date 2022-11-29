@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Create {{ucfirst(request()->segment(1))}}
    </div>
    <div class="card-body">
        
        <form action="{{route('venue.update', $entry->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Name</label>
                <input type="input" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$entry->name}}">
                <label for="input"><span class="text-danger">*</span> Address</label>
                <input type="input" class="form-control" id="name" name="address" placeholder="Enter Name" value="{{$entry->address}}">
                <label for="name"><span class="text-danger">*</span> Contact Number</label>
                <input type="tel" class="form-control" id="name" name="contact_number" placeholder="Enter Name" value="{{$entry->contact_number}}">
                @foreach ($errors->all() as $error) 
                    <small id="emailHelp" class="form-text text-danger">{{ $error }}</small>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection