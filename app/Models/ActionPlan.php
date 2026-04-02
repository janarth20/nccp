<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ActionPlan extends Model
{
    protected $fillable = [
        'cloud_stack_id',
        'lead_agency_id',
        'activity',
        'measurement_indicator',
        'implementation_target',
        'duration',
        'start_year',
        'end_year',
        'implementation_status'
    ];

    public function leadAgency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'lead_agency_id');
    }

    public function supportingAgencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class, 'action_plan_support');
    }

    /**
     * Alias for supportingAgencies to satisfy eager loading in DashboardController
     */
    public function agencies(): BelongsToMany
    {
        return $this->supportingAgencies();
    }
}