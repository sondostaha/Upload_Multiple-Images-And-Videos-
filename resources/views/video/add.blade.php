@extends('layouts.layout')
@section('title')
Add new Image
@endsection
@section('contant')

@include('inc.errors')
<div class="container mt-5">
    <form action="{{ route('save.video') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

           <div class="col-md-12">
              <div class="col-md-6 form-group">
                 <label>Title:</label>
                 <input type="text" name="title" class="form-control"/>
              </div>
              <div class="col-md-6 form-group">
                 <label>Select Video:</label>
                 <input type="file" name="videos[]" class="form-control" multiple/>
              </div>
              <div class="col-md-6 form-group">
                 <button type="submit" class="btn btn-success">Save</button>
              </div>
           </div>
        </div>
     </form>
</div>
@endsection