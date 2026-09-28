<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Activity;

class containers extends Model
{
    use LogsActivity;
    protected $table ='containers';
    protected $fillable =[
        'serial_number',
        'location_name',
        'latitude',
        'longitude',
        'fill_level',
        'status',
    ];
    public function  materials()
    {
            return $this->hasMany(materials::class,'container_id');
    }
    public function getActivitylogOptions() :LogOptions
    {
        return LogOptions::defaults()->logAll()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }


}
