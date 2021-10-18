<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\Specialist;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function getSchedule($specialist_id, $service_id) {
        $specialist = Specialist::find($specialist_id);
        $service = Service::find($service_id);

        $date1 = Carbon::today()->addDay()->toDateString();
        $date2 = Carbon::today()->addWeek()->toDateString();
        $sessionsFor = Session::where('service_id', '=', $service_id)->where('specialist_id', '=', $specialist_id);
        $sessions = $sessionsFor->whereBetween('scheduled_time', [$date1, $date2])->get();
        return view('schedule')->with('specialist', $specialist)->with('service', $service)->with('sessions', json_encode($sessions));
    }

    public function book(Request $request) {
        if(Auth::user()->is_admin == 1) {
            return redirect()->route('schedule.create');
        }

        $valid = $request->validate([
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:specialists,id',
            'date' => 'required|date_format:d/m/Y',
            'hour' => 'required|integer'
        ]);

        $user = Auth::user();
        srand($user->id);

        $dateparts = explode('/', $valid['date']);

        $date = new Carbon($dateparts[2] .'-'. $dateparts[1] .'-'. $dateparts[0] .' '. $valid['hour'] . ':00:00');
        // return $date;

        $session = new Session();
        $session->name = $user->name;
        $session->phone = '08' . rand(10000000, 99999999);
        $session->service_id = $valid['service_id'];
        $session->specialist_id = $valid['specialist_id'];
        $session->scheduled_time = $date;
        $session->save();

        return view('success')
            ->with('date', $date)
            ->with('service', Service::find($session->service_id))
            ->with('specialist', Specialist::find($session->specialist_id));
    }
}
