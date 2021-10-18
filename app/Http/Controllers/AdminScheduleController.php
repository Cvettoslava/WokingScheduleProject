<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\Specialist;

class AdminScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::orderBy('scheduled_time')->where('confirmed', '=', 1)->paginate(15);
        echo $sessions;
        return view ('admin.schedule.index')->with('sessions', $sessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialists = Specialist::with('services')->get();
        $services = Service::all();

        return view ('admin.schedule.create')->with('specialists', $specialists)->with ('services', $services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specialists = Specialist::with('services')->get();
        $services = Service::all();

        $validatedData = $request->validate([
            "name" => "required|max:50",
            "phone" => "required|regex:/^08\d{8}$/i",
            "service_id" => ["required"],
            "specialist_id" => ["required"],
            "scheduled_time" => "date_format:d.m.Y|required",
            "time" => "date_format:H:i"
        ]);

        $date = $validatedData['scheduled_time'] . " " . $validatedData['time'];
        $entry = new Session();
        $entry->name = $validatedData['name'];
        $entry->phone = $validatedData['phone'];
        $entry->service_id = $validatedData['service_id'];
        $entry->specialist_id = $validatedData['specialist_id'];
        $entry->scheduled_time = new Carbon($date);
        $entry->name = $validatedData['name'];
        $entry->confirmed = true;

        $currentTime = Carbon::now()->addHours(3);

        if ($entry->scheduled_time->lte($currentTime)){
            return view('admin.schedule.create')->with('specialists', $specialists)->with ('services', $services)
                    ->withErrors([
                        "scheduled_time" => "It is not possible to save the record in the past!"
                    ]);
        }else {
            /*$servicesDurations = Service::all('id','duration');
            $sessionsTimes = Session::all('service_id','scheduled_time');*/
                
            $sessions = Session:: where('scheduled_time', '=', $entry->scheduled_time)->get();
            if($sessions->count()>0){
                if($sessions->where('specialist_id', '=', $request->specialist_id)->count() > 0){
                    return view('admin.schedule.create')->with('specialists', $specialists)->with ('services', $services)
                    ->withErrors([
                        "specialist_id" => "This Time is busy for this specialist!"
                      ]);
                }else{
                    //$result = $sessionsTimes->scheduled_time + $servicesDurations->duration;
                    //if($servicesDurations->where('id','=', $sessionsTimes->service_id)){
                    //}else{
                    $entry->save();
                    //}     
                }
            }else{
                $entry->save();
            }
        }
        return redirect()->route('schedule.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::all();
        $specialists = Specialist::with('services')->get();

        $session = Session:: find($id);
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $session->scheduled_time)->format('H:i');
    
        return view('admin.schedule.edit')->with('session', $session)->with('time', $time)->with ('services',$services)
        ->with ('specialists',$specialists);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $services = Service::all();
        $specialists = Specialist::with('services')->get();

        $session = Session:: find($id);
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $session->scheduled_time)->format('H:i');

        $validatedData = $request->validate([
            "name" => "required|max:50",
            "phone" => "required|regex:/^08\d{8}$/i",
            "service_id" => ["required"],
            "specialist_id" => ["required"],
            "scheduled_time" => "date_format:d.m.Y|required",
            "time" => "date_format:H:i"
        ]);

        $date = $validatedData['scheduled_time'] . " " . $validatedData['time'];
        $entry = Session::find($id);
        $entry->name = $validatedData['name'];
        $entry->phone = $validatedData['phone'];
        $entry->service_id = $validatedData['service_id'];
        $entry->specialist_id = $validatedData['specialist_id'];
        $entry->scheduled_time = new Carbon($date);
        $entry->name = $validatedData['name'];

        $currentTime = Carbon::now()->addHours(3); 
        if ($entry->scheduled_time <= $currentTime){
            return view('admin.schedule.edit')->with('session', $session)->with('time', $time)->with ('services',$services)
            ->with ('specialists',$specialists)
                    ->withErrors([
                        "scheduled_time" => "It is not possible to save the record in the past!"
                    ]);
        }else {
                            
            $sessions = Session:: where('scheduled_time', '=', $entry->scheduled_time)->get();
            if($sessions->count()>0){
                if($sessions->where('specialist_id', '=', $request->specialist_id)->count() > 0){
                    return view('admin.schedule.edit')->with('session', $session)->with('time', $time)->with ('services',$services)
                    ->with ('specialists',$specialists)
                    ->withErrors([
                        "specialist_id" => "This Time is busy for this specialist!"
                      ]);
                }else{                    
                    $entry->save();
                }
            }else{
                $entry->save();
            }
        }

        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session:: find($id);
        $session->delete();

        return redirect()->route('schedule.index');
    }

    public function delete($id)
    {
        $session = Session:: find($id);
        return view ('admin.schedule.delete')-> with ('session', $session );
    }
}
