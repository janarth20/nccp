<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'acronym'];

    /**
     * Action plans where this agency is the Lead.
     */
    public function leadingActionPlans()
    {
        return $this->hasMany(ActionPlan::class, 'lead_agency_id');
    }

    /**
     * Action plans where this agency is a Supporting partner.
     */
    public function supportingActionPlans()
    {
        return $this->belongsToMany(ActionPlan::class, 'action_plan_support');
    }

    /**
     * Legacy/Generic link to action plans.
     * Consider migrating usage to leadingActionPlans or supportingActionPlans.
     */
    public function actionPlans()
    {
        return $this->supportingActionPlans();
    }
}
