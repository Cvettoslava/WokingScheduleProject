<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ["Катя", "Ивана", "Дияна", "Силвия", "Славена", "Петя", "Ива", "Мария"];
        for($i = 1; $i < 3; $i++) {
            for($j = 0; $j <= $clients.count(); $j++) {
                $date = Carbon::create("2021-09-" . $i . ' ' . rand(8, 17) . ':00')->toDateTimeString();
                // echo $date;

                $session = new Session;
                $session->name = "Test session";
                $session->service_id = 10;
                $session->specialist_id = 21;
                $session->phone = "0888217831";
                
                $session->scheduled_time = $date;
                $session->save();
            }
        }
    }
}
