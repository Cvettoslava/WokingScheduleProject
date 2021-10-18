@extends('layouts.app')
@section('content')

<div class="container">
    <div class="hero" style="background-image: url('/images/hero-background.jpg')">
        <h2 class="pb-8">Beauty Salon</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil sit blanditiis maxime.</p>

        <div class="pt-4">
            <a href="{{ route('services') }}" class="btn btn-primary">Book now</a>
        </div>
    </div>

    <h2 class="pt-4">Find us</h2>
    <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=veliko%20tarnovo&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">add google maps html</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
</div>

@endsection