@extends('layouts.layout')
@section('title')
Add new Image
@endsection
@section('contant')

@include('inc.errors')
<div class="container mt-5">
  <form method="POST" action="{{ route('save.image') }}" enctype="multipart/form-data">
      @csrf
      
      <div class="form-group">
        
        <input type="text" class="form-control"  name="title" placeholder="Title" value="{{old('title')}}">
      </div>

    
      <div class="mb-3">
        
        <input class="form-control" type="file" name="images[]" multiple>
      </div>
      
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection