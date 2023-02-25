<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\State;
use App\Models\PostalCode;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function state(){
    	return $this->belongsTo(State::class,'state_id','id');
    }

    public function district(){
    	return $this->belongsTo(District::class,'district_id','id');
    }

    public function pincode(){
    	return $this->belongsTo(PostalCode::class,'pincode_id','id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

}
