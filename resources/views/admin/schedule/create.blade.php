@extends('layouts.app')
 
@section('content')
<div class="container">
    <a href="{{ route('schedule.index') }}" class="btn btn-link text-secondary">Go Back</a>
    @if ($errors->count()>0)
    <ul>
      @foreach ($errors->all() as $message)
        <li>
          {{$message}}
        </li>
      @endforeach
    </ul>
    @endif 
    <form action="{{ route('schedule.store') }}" method="POST">
      @csrf <!--Cross Site Reference Forgery (CSRF) token-->
 
      <div class="field-group">
        <label for="name">Client name</label>
        <input required class="form-control" type="text" name="name" placeholder="Enter name">
      </div>
      <div class="field-group">
        <label for="phone">Client phone</label>
        <input required class="form-control" type="text" name="phone" placeholder="08...">
      </div>
      <div class="field-group">
        <div><label for="service_id">Service</label></div>
        <select class="form-select" name = 'service_id' id="service-select">
            <option selected>Please select</option>
                          
        @foreach($services as $service) {
        
            <option class="service-option" value="{{$service->id}}">{{$service->name}} - {{$service->price}}$</option>
          
          @endforeach
          </select>        
      </div>
      <div class="field-group">
        <div><label for="specialist_id">Specialist</label></div>
        <select class="form-select" name='specialist_id' id="specialist-select">
            <option selected>Please select</option>
            @foreach($specialists as $spec)
              <option value="{{$service->id}}">{{$spec->name}}</option>
            @endforeach
          </select>
            
      </div>
      <div class="field-group">
        <label for="scheduled_time">Select date</label>
        <input type="text" class="form-control datetimepicker" name="scheduled_time">
      </div>
      <div class="field-group">
        <label for="time">Select time</label>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          <div style="margin-right: 1em; margin-bottom: 1em" class="btn-group btn-group-toggle" role="group" aria-label="Before lunch" data-toggle="buttons">
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="08:00" autocomplete="off" checked>
              8:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="09:00" autocomplete="off">
              9:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="10:00" autocomplete="off">
              10:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="11:00" autocomplete="off">
              11:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="12:00" autocomplete="off">
              12:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="13:00" autocomplete="off">
              13:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="14:00" autocomplete="off">
              14:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="15:00" autocomplete="off">
              15:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="16:00" autocomplete="off">
              16:00
            </label>
            <label type="button" class="btn btn-secondary">
              <input type="radio" name="time" value="17:00" autocomplete="off">
              17:00
            </label>
          </div>
        </div>
      </div>
      <div class="field-group">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
@endsection
 
@section('scripts')
 
<script>
  window.addEventListener('load', function() {
    $('.datetimepicker').datepicker({format: 'dd.mm.yyyy'});
  })

  // get the specialists from laravel
   const specialists = {!! json_encode($specialists) !!};

   // initialize service select and specialist select DOM nodes (<select name="services"> and <select name="specialists>)
   const serviceSelect = document.querySelector("#service-select");
   const specialistSelect = document.querySelector('#specialist-select')

   // function gets called when the value of the <select name="service"> changes
   serviceSelect.addEventListener("change", function(event) {
     let clickedServiceId = event.target.value; // Get the ID of the selected service

     // Get a list of specialists that offer that service
     let specialistsThatOfferSelectedService = specialists.filter(function(specialist) {
       const services = specialist.services;

       for(let i = 0; i < services.length; i++) {
         if(services[i].id === Number(clickedServiceId))
          return true;
       }

       return false;
     });

     // Set the content of the <select name="specialists"> to only show those who offer that service
     specialistSelect.innerHTML = `
      <option selected>Please select</option>
      ${specialistsThatOfferSelectedService.map(specialist => {
        return '<option value="' + specialist.id + '">' + specialist.name + "</option>"
      }).join("")}
     `
   });

   console.log(specialists);
</script>
 
@endsection