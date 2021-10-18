@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Success</h2>

    <p>We have received your request and will contact you shortly to confirm</p>
    <div>
        <h4>Details:</h4>
        <p>Service: {{$service->name}}</p>
        <p>Date: {{$date}}</p>
        <p>Specialist: {{$specialist->name}}</p>
    </div>

    <a href="/" class="btn btn-primary">Return to Home</a>
</div>
@endsection

