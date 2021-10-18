<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
//use DB;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Category;
use App\Models\Contact;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::all();
        $specialists = Specialist::with('services')->get();
        return view('home')->with('services', $services)->with('specialists', $specialists);
    }

    
    //have to create route, view
    public function userSchedule($service, $dateFrom, $dateTo){
        
        return view('userSchedule')->with('sessions', $sessions);
    }

    //have to create route, view
    public function bookАppointment(){
        return view('bookАppointment');
    }

    public function getContact()
    {
        return view('contact');
    }

    public function saveContact(Request $request) { 

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        
        return view('contact')->with('success', 'Thank you for contact us!');

    }

    public function welcome(){
        $latest_scheduled_sessions = Session::orderByDesc('scheduled_time')->with('service')
                                    ->limit(6)
                                    ->get();
                                   
        return view('welcome')->with('sessions', $latest_scheduled_sessions);
    }
    
    public function services() {
        // $services = Service::with('specialists')->groupBy('category_id')->get();
        $services = \DB::table('services')->get()->groupBy('category_id');
        $categories = Category::all();

        // var_dump($services);
        // return json_encode($services);
        return view('services')->with('groupedServices', $services)->with('categories', $categories);
    }

    public function pickSpecialist($service_id) {
        $service = Service::find($service_id);
        $specialists = $service->specialists;
        
        return view('pickSpecialist')->with('service', $service)->with('specialists', $specialists);
    }

    public function nailServices(){
        $nailServices = Service::with('specialists')->where('category_id',3)->get();
        
        return view('nailServices')->with('nailServices', $nailServices);        
    }

    public function hairServices(){
        $hairServices = Service::with('specialists')->where('category_id',2)->get();
       
        return view('hairServices')->with('hairServices', $hairServices);//->with('specialists', $specialists);        
    }

    public function skinServices(){
        $skinServices = Service::with('specialists')->where('category_id',1)->get();
        
        return view('skinServices')->with('skinServices', $skinServices);//->with('specialists', $specialists);        
    }

}
