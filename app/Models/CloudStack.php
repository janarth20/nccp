<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CloudStack extends Model
{
    protected $fillable = ['pillar_id', 'stack_number', 'title'];

    public function pillar()
    {
        return $this->belongsTo(Pillar::class);
    }

    public function actionPlans()
    {
        return $this->hasMany(ActionPlan::class);
    }
}