<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Capsule extends Model{

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
