@extends('layouts.app')


@section('content')
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
<div class="card-header">
    <div class="d-flex justify-content-between">
        All Event
        @can('isAdmin')
        <a href="{{'event/create'}}" class="btn btn-primary">Create</a>
        @endcan
    </div>
  </div>
    <div class="card-body">
        <form action="{{route('event.index')}}" method="get">
          <label for="search">Search</label>
          <input type="input" class="form-control mt-02" id="name" value="{{ old('title') }}" name="title" placeholder="search by title" >
		  <div class="row m-3">
			  <div class="form-group col">
				<label for="artist">Artist</label>
				<select class="custom-select" name="artist_id">
				  <option value="">select artist</option>
				@foreach($artists as $artist)
				<option value="{{$artist->id}}" >{{$artist->name}}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group col">
				<label for="genre">Genre</label>
				<select class="custom-select" name="genre_id">
				<option value="">select genre</option>
				@foreach($genres as $genre)
				<option value="{{$genre->id}}" >{{$genre->name}}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group col">
				<label for="venue">Venue</label>
				<select class="custom-select" name="venue_id">
				  <option value="">select venue</option>
				@foreach($venues as $venue)
				<option value="{{ $venue->id }}" >{{$venue->name}}</option>
				@endforeach
				</select>
			</div>
			<div class="col">
				<a href="{{ route('event.index') }}" class="btn btn-light">Clear</a>
				<button type="submit" class="btn btn-primary col " >Filter</button>
			</div>
			
		</div>
        </form>
        @if($events->isNotEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Title</th>
              <th scope="col">Artist</th>
              <th scope="col">Genre</th>
              <th scope="col">Venue</th>
              {{-- <th scope="col">Image</th> --}}
              <th scope="col">Description</th>
              <th scope="col">Event On</th>
              @can('isAdmin')
              <th scope="col">Action</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach ($events as $event)
            <tr>
              <td class="align-middle">{{$event->id}}</td>
              {{-- <td class="align-middle">{{$event->title}}</td> --}}
              <td class="align-middle"><a href="{{ route('event.show', $event->id) }}">{{$event->title}}</a></td>
              {{-- <td class="align-middle"><a href="{{ url('public/EventImages/'.$event->image) }}">{{$event->title}}</a></td> --}}
              <td class="align-middle">{{$event->artist->name}}</td>
              <td class="align-middle">{{$event->genre->name}}</td>
              <td class="align-middle">{{$event->venue->name}}</td>
              {{-- <td class="align-middle">{{$event->image}}</td> --}}
              <td class="align-middle">{{substr($event->description, 0, 60)}}...</td>
              <td class="align-middle">{{$event->event_on}}</td>
              @can('isAdmin')
              <td class="align-middle">
                <a href="{{'event/'.$event->id.'/edit'}}" class="btn btn-primary mt-01">Edit</a>
                <form action="{{route('event.destroy', $event->id)}}" method="post" class="mt-01" style="display:contents;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"class="btn btn-danger">Delete</button>
                </form>
              </td>
              @endcan
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$events->links()}}
        @else 
        <p>No Event Found.</p>
        @endif

    </div>
</div>
@endsection