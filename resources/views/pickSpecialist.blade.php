@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Please choose a specialist you'd like to book with</h3>
    <h5>Service: {{$service->name}}</h5>

    <div>
        @foreach($specialists as $specialist)
            <div><a href="/schedule/{{$specialist->id}}/{{$service->id}}">{{$specialist->name}}</a></div>
        @endforeach
    </div>
</div>
@endsection