<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'content', 'status'];

    public function getStatusAttribute($value)
    {
        return $value ? 'active' : 'inactive';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ? 1 : 0;
    }
}
