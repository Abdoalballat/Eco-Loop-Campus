<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class login extends Authenticatable
{
        use HasUuids;//,LogsActivity ,CausesActivity ;
        protected $table ='login';
        protected $fillable =[
                'university_id', //student
                'name',
                'email'
                ,'password'
                ,'college'        //student
                ,'role'
                ,'points'       //student
                ,'otp'
                ,'otp_expires_at'];
        public function  materials()
        {
                return $this->hasMany(materials::class,'user_id');
        }
        // public function getActivitylogOptions(): LogOptions 
        // {
        //         return LogOptions::defaults()
        //         ->logOnly(['email','role','name'])
        //         ->logOnlyDirty()
        //         ->dontSubmitEmptyLogs()
        //         ->setDescriptionForEvent(fn(string $eventName) => "Users has been{$eventName}");
        // }
        
}
