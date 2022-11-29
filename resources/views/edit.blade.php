@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit {{ucfirst(request()->segment(1))}}
    </div>
    <div class="card-body">
        @if(request()->segment(1) == "artist")
        <form action="{{route('artist.update', $entry->id)}}" method="post">
        @else
        <form action="{{route('genre.update', $entry->id)}}" method="post">
        @endif    
            @csrf
            @method('PUT')
        <div class="form-group">
            <label for="name"><span class="text-danger">*</span> Name</label>
            <input type="input" class="form-control" id="name" name="name" value="{{$entry->name}}" placeholder="Enter Name">
            @foreach ($errors->get('name') as $message) 
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @endforeach
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection