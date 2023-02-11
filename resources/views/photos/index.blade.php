@extends('layouts.app')

@section('content')

<h1>Photos</h1>
    <div class="row">
    @foreach ($photos as $photo)      
    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <img src="/storage/albums/{{$photo->slug}}" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">{{$photo->name}}</p>
        </div>
      </div>
    </div>
    @endforeach
    </div>
@endsection