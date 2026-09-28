<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\containers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    protected $table= 'activity_log' ;
protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
        'weight',
        'material',
        'points',
        'university_id',
        'serial_number',];

        public function container()
        {
            return $this->belongsTo(containers::class,'serial_number','serial_number');
        }
}
