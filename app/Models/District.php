<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class District extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function state(){
    	return $this->belongsTo(State::class,'state_id','id');
    }
}
