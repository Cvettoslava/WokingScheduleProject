@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Book for {{$service->name}} with {{$specialist->name}}</h3>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        {{explode(' ', $specialist->name)[0]}} is available:
    </div>

    <div id="schedule" class="row">  
    </div>
</div>

<form method="POST" action="{{route('book')}}" id="book-form">
    @csrf
    <input type="hidden" name="date" id="date-field" value="">
    <input type="hidden" name="specialist_id" id="specialist_id" value="">
    <input type="hidden" name="service_id" id="service_id" value="">
    <input type="hidden" name="hour" id="hour" value="">
</form>

@endsection

@section('scripts')
<script>
    let bookDate = new Date();
    const sendBookRequest = (i) => {
        const dateTime = new Date(Date.parse(i));
        const form = document.querySelector('#book-form');
        const valueField = document.querySelector('#date-field');

        const specialistIdField = document.querySelector("#specialist_id"); 
        specialistIdField.value = "{{ $specialist->id }}";

        const serviceIdField = document.querySelector("#service_id"); 
        serviceIdField.value = "{{ $service->id }}";

        const hourField = document.querySelector('#hour');
        hourField.value = dateTime.getHours();

        // set the value of the input field to the given dateTime
        valueField.value = dateTime.toLocaleDateString('en-GB');
        // submit the form
        form.submit(); 

        // console.log(dateTime, i);
    };

    // function that adds '0' to the beginning of a number if it's less than 10
    // used to add zero to hours/minutes. e.g 15h 4m -> 15:04
    const addZero = num => num < 10 ? '0' + num : num;

    const weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    // parse sessions as json from laravel
    const sessionsInput = JSON.parse('{!!$sessions!!}');

    /* create an objects with all the sessions, empty by default
    // structure is: 
    {
        "date": [ 
            array with all the services from that date 
        ], 
        "another date": [ 
            all services from that other date
        ], 
        ...
    }
    */
    const sessions = {};

    // Populate the sessions object with 7 blank arrays, starting from today
    const date = new Date();
    date.setDate(date.getDate() + 1);

    for(let i = 0; i < 7; i++) {
        const dateString = `${date.getFullYear()}-${addZero(date.getMonth() + 1)}-${addZero(date.getDate())}`
        
        sessions[dateString] = [];

        date.setDate(date.getDate() + 1)
    }
    
    // go through each session and place it in the array of the corresponding date (or create one if one doesn't exist)
    sessionsInput.forEach(session => {
        const [date, time] = session.scheduled_time.split(' ');
        if(sessions[date]) {
            sessions[date].push(session);
        } else {
            sessions[date] = [session];
        }
    });

    const scheduleContainer = document.querySelector('#schedule');
    Object.keys(sessions).forEach(day => {
        // get the day of the week
        const dayDate = new Date(day);
        const dayOfWeek = weekDays[dayDate.getDay()];

        // skip the rest of the code if it's saturday or sunday (i.e don't list those times)
        if(dayOfWeek === "Saturday" || dayOfWeek == "Sunday") {
            return;
        }

        // create some HTML and for each hour between 8 and 18, add a "Book" button if the person is not busy then
        let html = `<h5>${dayOfWeek} (${dayDate.toLocaleDateString('en-GB')})</h5>`;
        for(let i = 8; i < 18; i++) {
            let isBusy = false;

            // the person is busy at that time if one of the sessions was booked for that time; loop through them and check
            sessions[day].forEach(session => {
                const [date, time] = session.scheduled_time.split(' ');

                const hour = parseInt(time.split(':')[0]);
                if(hour === i) {
                    isBusy = true;
                }
            });

            if(!isBusy) {
                bookDate = new Date(day);
                bookDate.setHours(i);
                let x = bookDate.toISOString();
                html += `<div><span style="font-weight: bold">${i}:00</span> <a class="btn btn-link" onclick="sendBookRequest('${x}')">Book</a></div>`;
            }
        }

        const div = document.createElement('div');
        div.className = "col col-md-4 col-sm-12";
        div.innerHTML = html;

        scheduleContainer.appendChild(div);
    });
    
</script>
@endsection