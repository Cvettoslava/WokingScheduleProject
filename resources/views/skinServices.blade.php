@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Skin services</h1>
    
    <div class="services">
    @foreach($skinServices as $service)
        <div class="service">
            <div class="service-image" >
                <div class="service-card__content">
                    <img src="{{$service->image_url}}" alt="{{$service->name}}"/>
                </div>
            </div>
                    <div class="service-content">
                        <h6>{{$service->name}}</h6>
                        <div class="description" title="{{$service->description}}">{{$service->description}}</div>

                        <div class="service-card__content-footer">
                            <span class="price">${{intval($service->price)}}</span>
                            <span class="cta"><i class="fas fa-book-open"></i></span>
                        </div>
                    </div>
            
        </div>
    @endforeach
    </div>
   
  </div>
@endsection

