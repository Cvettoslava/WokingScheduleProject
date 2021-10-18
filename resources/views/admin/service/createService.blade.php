@extends('layouts.app')
 
@section('content')
<div class="container">
    <a href="{{ route('admin.services') }}" class="btn btn-link text-secondary">Go Back</a>
    @if (isset($errors))
    <ul>
      @foreach ($errors->all() as $message)
        <li>
          {{$message}}
        </li>
      @endforeach
    </ul>
    @endif 
    <form action="{{ route('service.storeService') }}" method="GET">
      @csrf <!--Cross Site Reference Forgery (CSRF) token-->
 
      <div class="field-group">
        <label for="name">Name of the service</label>
        <input required class="form-control" type="text" name="name" placeholder="Enter name">
      </div>
      <div class="field-group">
        <label for="price">Service`s price</label>
        <input required class="form-control" type="text" name="price" placeholder="Price ..$">
      </div>
      <div class="field-group">
        <label for="duration">Service`s duration</label>
        <input required class="form-control" type="text" name="duration" placeholder="How long">
      </div>
      <div class="field-group">
        <div><label for="specialist_id">Specialist</label></div>
        <select class="form-select" name='specialist_id[]' id = 'specialist_id' multiple="multiple">            
          @foreach($specialists as $spec)
            <option value="{{$spec->id}}">{{$spec->name}}</option>
          @endforeach
        </select>
      </div>
          <div class="field-group">
        <div><label for="category_id">Category</label></div>
          <select class="form-select" name='category_id' >
            <option selected>Please select</option>
            @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          <div class="field-group">
        <label for="description">Description</label>
        <input required class="form-control" type="text" name="description" placeholder="Description..">
      </div>
      <div class="field-group">
        <label for="image_url">Image</label>
        <input required class="form-control" type="text" name="image_url" placeholder="Image..">
      </div>
      <div class="field-group">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
@endsection
 
