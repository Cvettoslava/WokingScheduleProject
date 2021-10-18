@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Are you sure you want to delete this record?</h1>

    <div class="row">
      <div class="col-sm-2"><strong>Name</strong>:</div>
      <div class="col-sm-10">{{ $service->name }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Price</strong>:</div>
      <div class="col-sm-10">{{ $service->price }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Duration</strong>:</div>
      <div class="col-sm-10">{{ $service->duration }}</div>
    </div>
    <div class="my-4">
      <form action="{{ route('service.destroyService', ['service' => $service->id]) }}" method="POST">
        {{method_field('GET')}}
        @csrf

        <button type="submit" class="btn btn-danger">Yes, I'm sure</button> <a href="{{ route('admin.services' )}}" class="text-info btn btn-link">No, take me back</a>
      </form>
    </div>
  </div>

@endsection