<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id','state_id','city_name'];


    public function state(){
        return $this->belongsTo(State::class);
    }
}
