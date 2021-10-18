<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Session extends Model
{
    use HasFactory;


    public function service()
    {
        
        return $this->belongsTo(Service::class);
    }
     
    public function specialist()
    {
        
        return $this->belongsTo(Specialist::class);
    }
}
