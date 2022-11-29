@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Create {{ucfirst(request()->segment(1))}}
    </div>
    <div class="card-body">
    @if(request()->segment(1) == "artist")
        <form action="{{route('artist.store')}}" method="post">
    @elseif(request()->segment(1) == "genre")
        <form action="{{route('genre.store')}}" method="post">
    @endif    
        @csrf
        <div class="form-group">
            <label for="name"><span class="text-danger">*</span> Name</label>
            <input type="input" class="form-control" id="name" name="name" placeholder="Enter Name">
            @foreach ($errors->get('name') as $message) 
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @endforeach
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
		</div>
        </form>
    </div>
</div>
@endsection