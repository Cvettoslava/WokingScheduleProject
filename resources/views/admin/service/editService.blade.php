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
    <form action="{{ route('service.updateService', ['service'=> $service->id]) }}" method="POST">
    {{method_field('Get')}}
      @csrf <!--Cross Site Reference Forgery (CSRF) token-->
 
      <div class="field-group">
        <label for="name">Name of the service</label>
        <input value="{{ $service->name }}" required class="form-control" type="text" name="name" placeholder="Enter name">
      </div>
      <div class="field-group">
        <label for="price">Service`s price</label>
        <input value="{{ $service->price }}" required class="form-control" type="text" name="price" placeholder="x$">
      </div>
      <div class="field-group">
        <label for="duration">Service`s duration</label>
        <input value="{{ $service->duration }}" required class="form-control" type="text" name="duration" placeholder="..h">
      </div>
      <div class="field-group">
        <div><label for="specialist_id[]">Specialist</label></div>
        <select class="form-select" name = 'specialist_id[]' id="specialist_id" multiple="multiple"> 
          @foreach($specialists as $spec)         
            <option value="{{$spec->id}}" required class="form-control" type="id" name="specialist_id[]">{{$spec->name}}</option>
          @endforeach
        </select>        
      </div>
      <div class="field-group">
        <div><label for="category_id">Service`category</label></div>
        <select class="form-select" name = 'category_id' id="category-select">          
        @foreach($categories as $category)   
            <option value="{{$category->id}}" required class="form-control" type="id" name="category_id">{{$category->name}}</option>
          @endforeach
          </select>        
      </div>
      <div class="field-group">
        <label for="description">Description</label>
        <input value="{{ $service->description }}"required class="form-control" type="text" name="description" placeholder="Description..">
      </div>
      <div class="field-group">
        <label for="image_url">Image</label>
        <input value="{{ $service->image_url }}"required class="form-control" type="text" name="image_url" placeholder="Image..">
      </div>
      <div class="field-group">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
@endsection
 
