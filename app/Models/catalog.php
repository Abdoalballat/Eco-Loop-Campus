<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class catalog extends Model
{
    use LogsActivity,HasFactory ;
    protected $table = 'catalog';
    protected $fillable =[
        'points',
        'type',
        'total_weight',
    ];
        public function  materials()
    {
            return $this->hasMany(materials::class ,'type_id');
    }
    public function getActivitylogOptions():LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['points','type'])->logOnlyDirty()->dontSubmitEmptyLogs()
        ->setDescriptionForEvent(fn(string $eventName) => "Catalog items has been{$eventName}");
    }
    
}
