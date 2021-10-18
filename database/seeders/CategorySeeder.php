<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use \App\Models\ScheduledSession;
use Carbon\Carbon;
use \App\Models\Service;
use \App\Models\Specialist;
use \App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = ["Nails","Hair","Skin"];

        foreach($categoryNames as $name){
            $category = new Category();
            $category->name = $name;
            $category->save();
        }

       /* $clients = ["Катя", "Ивана", "Дияна", "Силвия", "Славена"];
        $services = Service::all('name');//['Basic Polish', 'Shellac', 'Acrylic'];
        $specialists = Specialist::all('name');
        
        
            $session = new ScheduledSession();
            $session->name = $clients[rand(0, 4)];
            $session->phone = "08" . rand(7, 9) . rand(1000000, 9999999);
            $session->service_id = $services[rand(0, 7)];
            $session->scheduled_time = new Carbon(rand(1, 28). '.02.2021 '.rand(8,17).":00");
            $session->specialist_id = $specialists[rand(0, 4)];
            $session->save();*/
    }
}
