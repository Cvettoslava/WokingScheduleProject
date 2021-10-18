@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>All specialists</h1>
    <a href="{{ route('specialist.createSpecialist') }}" class="btn btn-link text-primary">Add</a>

    <table class="table table-hover">
      <thead>        
        <th>Name</th>
        <th>Phone</th>
        <th></th>
      </thead>
      <tbody>
        @foreach($specialists as $spec)
        <tr>          
          <td>{{ $spec->name }}</td>
          <td>{{ $spec->specPhone }}</td>
          <td><a href="{{ route('specialist.editSpecialist', ['specialist' => $spec->id]) }}" class="btn btn-info">Edit</a>
              <a href="{{ route('specialist.deleteSpecialist', ['specialist' => $spec->id]) }}" class="btn btn-text text-danger">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection