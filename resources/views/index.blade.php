@extends('layouts.app')


@section('content')
<div class="card">
<div class="card-header">
    <div class="d-flex justify-content-between">
        All {{ucfirst(request()->route()->uri)}}
        <a href="{{request()->route()->uri.'/create'}}" class="btn btn-primary">Create</a>

    </div>
  </div>
    <div class="card-body">
        @if($entries->isNotEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">name</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($entries as $entry)
            <tr>
              <td class="align-middle">{{$entry->id}}</td>
              <td class="align-middle">{{$entry->name}}</td>
              <td class="align-middle">{{$entry->created_at}}</td>
              <td class="align-middle">
                <a href="{{request()->route()->uri.'/'.$entry->id.'/edit'}}" class="btn btn-primary m-01">Edit</a>
                <form action="{{route(request()->route()->uri.'.destroy', $entry->id)}}" method="post" style="display:contents;" class="m-01">
                    @csrf
                    @method('DELETE')
                    <button type="submit"class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$entries->links()}}
        @else 
        <p>No Data Found.</p>
        @endif

    </div>
</div>
@endsection