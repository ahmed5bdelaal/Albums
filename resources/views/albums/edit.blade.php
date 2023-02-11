@extends('layouts.app')

@section('content')

<h1>Edit Album</h1>
<form action="{{route('albums.update',$album->id)}}" method="POST" >
    @csrf
    @method('post')
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" value="{{$album->name}}" class="form-control" id="name" placeholder="Album name">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="text" class="form-control" value="{{$album->description}}" id="description" name="description">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection