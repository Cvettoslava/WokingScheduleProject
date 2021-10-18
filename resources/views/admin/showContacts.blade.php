@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>All contacts</h1>
    
    <table class="table table-hover">
      <thead>       
        <th>Name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Subject</th>        
      </thead>
      <tbody>
      
      @foreach($contacts as $contact)
      <tr class="contact-row" data-contactid="{{$contact->id}}">
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->phone }}</td>
        <td>{{ $contact->subject }}</td>
        <td>
            <a href="{{ route('admin.contactDetails',  $contact->id) }}" class="btn btn-info">View details</a>
        </td>
      </tr>
      @endforeach       
      </tbody>
    </table>
  </div>
@endsection