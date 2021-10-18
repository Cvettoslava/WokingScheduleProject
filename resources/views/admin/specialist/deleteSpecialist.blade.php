@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Are you sure you want to delete this record?</h1>

    <div class="row">
      <div class="col-sm-2"><strong>Name</strong>:</div>
      <div class="col-sm-10">{{ $specialist->name }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Specialist` phone number</strong>:</div>
      <div class="col-sm-10">{{ $specialist->specPhone }}</div>
    </div>
    <div class="my-4">
      <form action="{{ route('specialist.destroySpecialist', ['specialist' => $specialist->id]) }}" method="POST">
        {{method_field('GET')}}
        @csrf

        <button type="submit" class="btn btn-danger">Yes, I'm sure</button> 
          <a href="{{ route('specialist.showSpecialists' )}}" class="text-info btn btn-link">No, take me back</a>
      </form>
    </div>
  </div>

@endsection