<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Specialist;
use App\Models\Service;
use App\Models\Category;
use App\Models\Session;
use App\Models\Contact;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }

    public function showContacts(){
        $contacts = Contact::all();
        return view('admin.showContacts')->with ('contacts', $contacts);
    }

    public function viewContactDetails($id){
        $contact = Contact::find($id);

        return view('admin.contactDetails')->with('contact', $contact);
    }

    public function dashboard() {
        $unconfirmedSessions = Session::where('confirmed', '=', '0')->get();
        return view('admin.dashboard')->with('unconfirmedSessions', $unconfirmedSessions);
    }

    public function showSpecialists(){
        $specialists = Specialist::all();
        return view('admin.specialist.showSpecialists')->with ('specialists', $specialists);
    }

    public function createService(){
        $specialists = Specialist::all();
        $categories = Category::all();

        return view ('admin.service.createService')->with ('specialists', $specialists)->with ('categories', $categories);
    }

    public function storeService(Request $request)
    {
        $specialists = Specialist::all();
        $categories = Category::all();

        $validatedData = $request->validate([
            "name" => "required|max:50",
            "price" => "required",//walidirane
            "duration" => ["required"],//walidirane
            "category_id" => ["required"],
            "description" => "required|max:2000",
            "image_url" => "required|max:500",
        ]);        

        $entry = new Service();
        $entry->name = $validatedData['name'];
        $entry->price = $validatedData['price'];
        $entry->duration = $validatedData['duration'];
        $entry->category_id = $validatedData['category_id'];
        $entry->description = $validatedData['description'];
        $entry->image_url = $validatedData['image_url'];

        if (Service::where('name', '=', $entry->name)->exists()) {
            // service found
            return view('admin.service.createService')->with('specialists', $specialists)->with ('categories', $categories)
                    ->withErrors([
                        "name" => "This Service already exists!"
                      ]);
        }else{
            $entry->save();
            $service = Service::find($entry->id);
               
            $selectedValues = $request['specialist_id'];

            foreach ($selectedValues as $selected){
                $service->specialists()->attach($selected, ['service_id' => $entry->id]);
            }
        }
        return redirect()->route('admin.services');
    }


    public function editService($id)
    {
        $specialists = Specialist::with('services')->get();

        $service = Service::find($id);
        $categories = Category:: all();
    
        return view('admin.service.editService')->with('service', $service)->with ('categories', $categories)->with ('specialists',$specialists);
    }

    public function updateService(Request $request, $id)
    {
        $specialists = Specialist::with('services')->get();
        $categories = Category:: all(); 

        $validatedData = $request->validate([
            "name" => "required|max:50",
            "price" => "required",//walidirane
            "duration" => ["required"],//walidirane
            "category_id" => ["required"],
            "description" => "required|max:2000",
            "image_url" => "required|max:500",
        ]);

        $service = Service::find($id);
        $service->name = $validatedData['name'];
        $service->price = $validatedData['price'];
        $service->duration = $validatedData['duration'];
        $service->category_id = $validatedData['category_id'];
        $service->description = $validatedData['description'];
        $service->image_url = $validatedData['image_url'];

             
        $selectedValues = $request['specialist_id'];
   
        $service->specialists()->detach();
        foreach ($selectedValues as $selected){
            $service->specialists()->attach($selected);
        }
        $service->save();
        
        return redirect()->route('admin.services');
    }

    public function destroyService($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('admin.services');
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        
        return view ('admin.service.deleteService')-> with ('service', $service );
    }


    public function createSpecialist(){
      
        return view ('admin.specialist.createSpecialist');
    }

    public function storeSpecialist(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|max:50",
            "specPhone" => "required|regex:/^08\d{8}$/i",
        ]);        

        $entry = new Specialist();
        $entry->name = $validatedData['name'];
        $entry->specPhone = $validatedData['specPhone'];

        if (Specialist::where('name', '=', $entry->name)->exists()) {
            // Specialist found
            return view('admin.specialist.createSpecialist')->withErrors([
                        "name" => "This Specialist already exists!"
                    ]);
        }
               
        $entry->save();

        return redirect()->route('specialist.showSpecialists');
    }


    public function editSpecialist($id)
    {
        $specialist = Specialist::find($id);

        return view('admin.specialist.editSpecialist')->with ('specialist',$specialist);
    }

    public function updateSpecialist(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required|max:50",
            "specPhone" => "required|regex:/^08\d{8}$/i",
        ]);

        $specialist = Specialist::find($id);
        $specialist->name = $validatedData['name'];
        $specialist->specPhone = $validatedData['specPhone'];

    
        $specialist->save();

        return redirect()->route('specialist.showSpecialists');
    }

    public function destroySpecialist($id)
    {
        $specialist = Specialist:: find($id);
        $specialist->delete();

        return redirect()->route('specialist.showSpecialists');
    }

    public function deleteSpecialist($id)
    {
        $specialist = Specialist::find($id);
        return view ('admin.specialist.deleteSpecialist')-> with ('specialist', $specialist);
    }

    public function confirmSession($id) {
        $session = Session::find($id);
        $session->confirmed = true;
        $session->save();

        return redirect()->route('admin.dashboard');
    }

    public function deleteSession($id) {
        $session = Session::find($id);
        $session->delete();

        return redirect()->route('admin.dashboard');
    }
}
