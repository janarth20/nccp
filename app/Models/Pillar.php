<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    protected $fillable = ['pillar_number', 'name', 'full_title'];

    public function cloudStacks()
    {
        return $this->hasMany(CloudStack::class);
    }
}