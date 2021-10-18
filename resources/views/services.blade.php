@extends('layouts.app')
@section('content')
<div class="services">
    <h3>Which service would you like to book for?</h3>

    @foreach($groupedServices as $category_id => $services)
        @foreach($categories as $category)
            @if($category->id == $category_id)
                <h4>{{$category->name}}</h4>
            @endif
        @endforeach

        @foreach($services as $service)
        <a href="{{route('pickSpecialist', $service->id)}}" class="btn btn-link text-primary">{{$service->name}}</a>
        @endforeach
    @endforeach
</div>
@endsection
