@extends('layouts.app')
@section('content')

<h1>Create Album</h1>
<form action="{{route('albums.store')}}" method="POST" >
    @csrf
    @method('post')
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Album name">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="text" class="form-control" id="description" name="description">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection