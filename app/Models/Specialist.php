<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use App\Models\Service;

class Specialist extends Model
{
    use HasFactory;
    public function services()
    {
        return $this->belongsToMany(Service::class,'service_specialist', 'specialist_id', 'service_id');
    }

    public function ScheduledSessions()
    {
        return $this->hasMany(Session::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($specialist) { // before delete() method call this
            $specialist->services()->detach();
            $specialist->ScheduledSessions()->delete();
            //$specialist->delete();
        });
    }
}