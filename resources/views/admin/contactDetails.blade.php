@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Contact details</h1>

    <div class="row">
      <div class="col-sm-2"><strong>Name of the user</strong>:</div>
      <div class="col-sm-10">{{ $contact->name }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Email of the user</strong>:</div>
      <div class="col-sm-10">{{ $contact->email }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>User`s phone number</strong>:</div>
      <div class="col-sm-10">{{ $contact->phone }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Subject</strong>:</div>
      <div class="col-sm-10">{{ $contact->subject }}</div>
    </div>
    <div class="row">
      <div class="col-sm-2"><strong>Message</strong>:</div>
      <div class="col-sm-10">{{ $contact->message }}</div>
    </div>
       
    <div class="my-4">
    <form action="{{ route('admin.contactDetails', ['contact' => $contact->id]) }}" method="POST">
        {{method_field('GET')}}
        @csrf
          <a href="{{ route('admin.showContacts' )}}" class="text-info btn btn-link">Take me back</a>
      </form>
    </div>
  </div>

@endsection