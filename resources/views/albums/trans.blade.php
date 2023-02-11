@extends('layouts.app')

@section('content')

<h1>Choose Albums </h1>
<div class="row">
    @foreach ($albums as $album)
<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$album->name}}</h5>
            <p class="card-text">{{$album->description}}</p>
            <a href="{{route('albums.transfer' ,[$album->id,$id])}}" class="btn btn-primary">Select</a>
        </div>
    </div>
</div>
    @endforeach
</div>

@endsection