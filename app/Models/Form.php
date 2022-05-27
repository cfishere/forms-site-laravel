<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Form extends Model
{
   
    protected $table = 'forms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'products',
        'dept_id',
        'name',
        'description',
        'fax'
    ];

    protected $guarded = [];

    protected $casts = [
        'products' => AsArrayObject::class,
    ];

    function allByDept($deptId)
    {
       /* return $this->belongsTo(Dept::class);*/
       /*TODO: Join with dept ->with() */
       return $this->where('dept_id', '=', $deptId)->get();
    }

    function dept()
    {
        return $this->belongsTo(Dept::class);
    }

    function submission(){
        return $this->hasMany(Submission::class, 'form_id', 'id');
    }

     /**
     * mutate vendor product listing when getting/setting.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
   /* protected function products(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }*/
}
