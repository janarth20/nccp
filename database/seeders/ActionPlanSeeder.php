<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActionPlan;
use App\Models\Agency;
use App\Models\CloudStack;

class ActionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create common dependencies for seeding
        $jdn = Agency::firstOrCreate(['acronym' => 'JDN'], ['name' => 'Jabatan Digital Negara']);
        $kd = Agency::firstOrCreate(['acronym' => 'KD'], ['name' => 'Kementerian Digital']);
        $nacsa = Agency::firstOrCreate(['acronym' => 'NACSA'], ['name' => 'NACSA']);
        
        $stack = CloudStack::first() ?? CloudStack::create([
            'pillar_id' => 1, 
            'stack_number' => 1, 
            'title' => 'Initial Cloud Infrastructure'
        ]);

        $ap = ActionPlan::create([
            'cloud_stack_id' => $stack->id,
            'lead_agency_id' => $jdn->id,
            'activity' => 'Establish centralized cloud platform; migrate min. 30% of systems',
            'measurement_indicator' => 'Cloud migration audit; percentage of cloud adoption by ministry',
            'implementation_target' => 'Complete migration (80% target); Enforce mandatory Cloud-First policy',
            'duration' => '2026 - 2030',
            'start_year' => 2026,
            'end_year' => 2030,
            'implementation_status' => 'initiated'
        ]);

        // Link multiple supporting agencies
        $ap->supportingAgencies()->attach([$kd->id, $nacsa->id]);
    }
}
