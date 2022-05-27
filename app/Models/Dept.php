<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;

    function company(){
        return $this->belongsTo(Company::class);
    }

    function form(){
        return $this->hasMany(Form::class);
    }

    function user(){
        return $this->hasMany(User::class,  'dept_id', 'id');
    }

     function head(){
        return $this->hasOne(User::class, 'id', 'head_userid');
    }
}
