@extends('layouts.app')

@section('content')
<div class="container">
    <h1> Admin dashboard</h1>
    
    <a href="{{ route('schedule.index') }}" class="btn btn-link">Schedule</a>
    <a href="{{ route('admin.services') }}" class="btn btn-link">Edit information about services</a>
    <a href="{{ route('specialist.showSpecialists') }}" class="btn btn-link">Edit information about specialists.</a>

    <div class="unconfirmed-sessions">
        <h3>Unconfirmed sessions</h3>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Service</th>
                <th>Specialist</th>
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if(sizeof($unconfirmedSessions) == 0)
                    <tr>
                        <td colspan="8" style="text-align: center; color: #AA5588">No unconfirmed sessions</td>
                    </tr>
                @endif
                @foreach($unconfirmedSessions as $session)
                <tr>
                    <td>{{$session->id}}</td>
                    <td>{{$session->name}}</td>
                    <td>{{$session->phone}}</td>
                    <td>{{$session->service->name}}</td>
                    <td>{{$session->specialist->name}}</td>
                    <td>{{$session->scheduled_time}}</td>
                    <td><a href="{{route('admin.confirmSession', $session->id)}}" class="btn btn-link text-primary">Confirm</a> <a href="{{route('admin.deleteSession', $session->id)}}" class="btn btn-link text-danger">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection