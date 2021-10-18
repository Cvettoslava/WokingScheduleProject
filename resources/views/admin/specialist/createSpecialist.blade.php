@extends('layouts.app')
 
@section('content')
<div class="container">
    <a href="{{ route('specialist.showSpecialists') }}" class="btn btn-link text-secondary">Go Back</a>
    @if (isset($errors))
    <ul>
      @foreach ($errors->all() as $message)
        <li>
          {{$message}}
        </li>
      @endforeach
    </ul>
    @endif 
    <form action="{{ route('specialist.storeSpecialist') }}" method="GET">
      @csrf <!--Cross Site Reference Forgery (CSRF) token-->
 
      <div class="field-group">
        <label for="name">Name of the new specialist</label>
        <input required class="form-control" type="text" name="name" placeholder="Enter name">
      </div>
      <div class="field-group">
        <label for="specPhone">Specialist number phone</label>
        <input required class="form-control" type="text" name="specPhone" placeholder="08...">
      </div>
      <div class="field-group">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
@endsection
 
