<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Submission extends Model
{
    protected $table = 'submissions';
     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
   /* protected $appends = ['data'];*/
    protected $guarded = [];
    protected $casts = [
        'data' => 'array',
    ];
   /* protected $casts = [
        'data' => AsArrayObject::class,
    ];*/



    
    /*protected $fillable = [
        'id',
        'data',
        'dept_id',
        'form_id',
        'owner_id',
        'vendor',
        'dept_name',
        'completed'
    ];    */

    function user(){
        return $this->hasOne(User::class, 'owner_id');
    }

    function recent(int $pagination){
        $result = $this->latest()->paginate($pagination);
        /*foreach($result as $collect){
            $collect->data = json_decode($collect->data, true);
        }*/
        return $result;
        
    }

    function form(){        
        return $this->belongsTo(Form::class, 'form_id');        
    }

    function dept(){       
        return $this->belongsTo(Dept::class, 'dept_id');        
    }


    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
   /* protected function data(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );        
    }*/
}
