<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class materials extends Model
{
    protected $table ='materials';
    protected $fillable =[
        'type_id'
        ,'container_id'
        ,'user_id'
        ,'weight'
    ];
            public function login() 
        {
                return $this->belongsTo(login::class,'user_id');
        }
            public function container() 
        {
                return $this->belongsTo(containers::class,'container_id');
        }
            public function catalog() 
        {
                return $this->belongsTo(catalog::class,'type_id');
        }
}
