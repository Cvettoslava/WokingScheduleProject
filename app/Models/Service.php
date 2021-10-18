<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduledSession;
use App\Models\Specialist;
use App\Models\Category;


class Service extends Model
{
    use HasFactory;
    
    public function ScheduledSessions()
    {
        return $this->hasMany(Session::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class);
    }

    public function category()
    {
        
        return $this->belongsTo(Category::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($service) { // before delete() method call this
            $service->specialists()->detach();
            $service->ScheduledSessions()->delete();
            //$service->delete();    
        });
    }
}
