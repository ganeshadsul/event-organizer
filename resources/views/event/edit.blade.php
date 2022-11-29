@extends('layouts.app')
@push('css')
	<style>
		input[type="event-old-image"]{
			color: transparent;
			text-shadow: 0 0 0 #000;
			padding: 6px 12px;
			width: 150px;
			cursor: pointer;
		}
		input[type="event-old-image"]:focus{
			outline: none;
			display:none;
		}
		input:focus + div#content {
			display: block;
		}
	</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        Create {{ucfirst(request()->segment(1))}}
    </div>
    <div class="card-body">
        
		<form action="{{route('event.update', $event->id)}}" method="post" enctype="multipart/form-data">
            @csrf
			@method('PUT')
            <div class="form-group">
                <label for="title"><span class="text-danger">*</span> Title</label>
                <input type="input" class="form-control" id="name" name="title" placeholder="Enter Title" value="{{ $event->title }}">
				<div class="row m-2">
					<div class="col">
						<label for="artist"><span class="text-danger">*</span>Artist: </label>
						<select class="custom-select" name="artist_id">
						@foreach($artists as $artist)
						<option value="{{$artist->id}}"  {{$artist->id == $event->artist->id ? 'selected' : ""}}>{{$artist->name}}</option>
						@endforeach
						</select>
					</div>
					<div class="col ">
						<label for="genre"><span class="text-danger">*</span>Genre: </label>
						<select class="custom-select" name="genre_id">
						@foreach($genres as $genre)
						<option value="{{$genre->id}}"  {{$genre->id == $event->genre->id ? 'selected' : ""}}>{{$genre->name}}</option>
						@endforeach
						</select>
					</div>
					<div class="col">
						<label for="venue"><span class="text-danger">*</span>Venue: </label>
						<select class="custom-select" name="venue_id">
						@foreach($venues as $venue)
						<option value="{{ $venue->id }}"  {{$venue->id == $event->venue->id ? 'selected' : ""}} >{{$venue->name}}</option>
						@endforeach
						</select>
					</div>
				</div>
                
                <label for="input" class="mt-2"><span class="text-danger">*</span> Image</label>
				<input type="file" class="form-control" id="name" name="image" >
                <label for="name" class="mt-2"><span class="text-danger">*</span> Description</label>
                <textarea class="form-control" id="name" name="description" placeholder="Enter Description">{{ $event->description }}</textarea>
                <label for="name" class="mt-2"><span class="text-danger">*</span> Amount</label>
                <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="name" name="amount" placeholder="Enter Amount" value = "{{ $event->amount }}" >
                <label for="name" class="mt-2"><span class="text-danger">*</span> Event On</label>
                <input type="date" class="form-control" id="name" name="event_on" placeholder="Enter Even Date" value="{{ $event->event_on }}">
                @foreach ($errors->all() as $error) 
                    <small id="emailHelp" class="form-text text-danger">{{ $error }}</small>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
@endsection