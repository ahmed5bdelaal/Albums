@extends('layouts.app')

@section('content')
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">&times;</span>
      <p>Remove</p>
      @if (count($album->photos) > 0)
          <form action="{{route('albums.destroy',$album->id)}}" method="POST">
            @method('DELETE')
            @csrf
          <button style="width: 100%" class="btn btn-danger my-2">Remove</button>
          </form>
          <a href="{{route('albums.trans',$album->id)}}" class="btn btn-danger my-2">Transfer to another album</a>

      @else
          <form action="{{route('albums.destroy',$album->id)}}" method="POST">
            @method('DELETE')
            @csrf
          <button class="btn btn-danger my-2">Remove</button>
          </form>
      @endif
  </div>

</div>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">{{$album->name}}</h1>
        <p class="lead text-muted">{{$album->description}}</p>
        <p>
          <button id="myBtn" class="btn btn-danger my-2">Remove</button>
          <a href="/photo/upload/{{$album->id}}" class="btn btn-primary my-2">Upload Photo</a>
          <a href="{{route('albums.edit',$album->id)}}" class="btn btn-primary my-2">Edit</a>
          <a href="/albums" class="btn btn-secondary my-2">Back</a>
        </p>
      </div>
    </div>
  </section>
@if (count($album->photos) > 0)


<div class="row">
    @foreach ($album->photos as $photo)
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="/storage/albums/{{$photo->slug}}" height="200px" class="card-img-top" alt="photo Image">
            <div class="card-body">
                <h5 class="card-title">{{$photo->name}}</h5>
                <a href="{{route('photos.show' , $photo->id)}}" class="btn btn-primary">View</a>
                <form action="{{route('photos.destroy',$photo->id)}}" method="POST">
                  @method('DELETE')
                  @csrf
                <button style="float: right" type="submit" class="btn btn-danger">remove</a>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

  @else
    <p>No photos to display</p>
  @endif
  
@endsection
