<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'descripcion',
        'state_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];


    protected $appends = ['resource_url'];
    protected $with = ['state'];

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/services/'.$this->getKey());
    }
}
