<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = [
        'descripcion',
        'url',
        'password',
        'category_id',
        'service_id',
    
    ];
    
    protected $hidden = [
        'password',
    
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/credentials/'.$this->getKey());
    }
}
