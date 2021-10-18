@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>All services</h1>
    
    <table class="table table-hover">
      <thead>       
        <th>Name</th>
        <th>Price</th>
        <th>Duration</th>
        <th>Specialist</th>        
      </thead>
      <tbody>
      
      @foreach($services as $service)
      <tr class="service-row" data-serviceid="{{$service->id}}">
        <td>{{ $service->name }}</td>
        <td>{{ $service->price }}$</td>
        <td>{{ $service->duration }}</td>
      </tr>
      @endforeach       
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
<script>
  const specialists = {!! json_encode($specialists) !!};

  const serviceRows = document.getElementsByClassName('service-row');
  for(let i = 0; i < serviceRows.length; i++) {
    const id = serviceRows[i].dataset.serviceid; 

    const specialistsForThatService = specialists.filter(function(specialist) {
      for(let j = 0; j < specialist.services.length; j++) {
        if(specialist.services[j].id === Number(id))
          return true;
      }

      return false;
    });

    const specialistNames = specialistsForThatService.map(function(specialist) {
      return specialist.name
    }).join(", ");

    const td = document.createElement("td");
    td.innerHTML = specialistNames;

    serviceRows[i].appendChild(td);
  }

</script>
@endsection