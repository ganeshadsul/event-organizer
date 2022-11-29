@extends('layouts.app')
@push('css')
<style>
	.event-image {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	.description{
		padding: 1%;
		text-align: justify;
	}
</style>
@endpush
@section('content')
<div class="container">
	<div class="card">
	  <div class="card-header">
		{{ $event->title }}
	  </div>
	  <div class="card-body">
		<img class="event-image" src="{{ url('images/event-images').'/'.$event->image }}" alt="{{ $event->title }}  image" height="350px" width="550px">
		<p class="card-text"><b>Artist</b>: {{ $event->artist->name }}</p>
		<p class="card-text"><b>Date</b>: {{ $event->event_on }}</p>
		<p class="card-text"><b>Venue</b>: {{ $event->venue->name }}</p>
		<p class="card-text description"><b>Decprition:</b> {{ $event->description }}</p>
		<p class="card-text"><b>Amount</b>: ₹{{ $event->amount }}</p>
	  </div>
	</div>
</div>




{{-- <div class="card mb-3">
  <img src="{{ url('/images/event-images').'/'.$event->image ?? '' }}" class="card-img-top container" alt="event image" style="height: 400px; width:700px;">
  <div class="card-body">
    <h5 class="card-title">{{ $event->title }}</h5>
    <p class="card-text">Event on: {{ $event->event_on }}</p>
    <p class="card-text">{{ $event->description }}</p>
  </div>
</div> --}}
@endsection
