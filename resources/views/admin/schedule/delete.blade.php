@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Are you sure you want to delete this record?</h1>

    <div class="row">
      <div class="col-sm-2"><strong>Name</strong>:</div>
      <div class="col-sm-10">{{ $session->name }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Phone</strong>:</div>
      <div class="col-sm-10">{{ $session->phone }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Service</strong>:</div>
      <div class="col-sm-10">{{ $session->service }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Date</strong>:</div>
      <div class="col-sm-10">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $session->scheduled_time)->format('d M Y H:i') }}</div>
    </div>
    <div class="my-4">
      <form action="{{ route('schedule.destroy', ['schedule' => $session->id]) }}" method="POST">
        {{method_field('DELETE')}}
        @csrf

        <button type="submit" class="btn btn-danger">Yes, I'm sure</button> <a href="{{ route('schedule.index' )}}" class="text-info btn btn-link">No, take me back</a>
      </form>
    </div>
  </div>

@endsection