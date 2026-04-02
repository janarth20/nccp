<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pillar;
use App\Models\CloudStack;
use App\Models\ActionPlan;
use App\Models\Agency;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $jdn = Agency::updateOrCreate(['id' => 1], ['name' => 'Jabatan Digital Negara', 'acronym' => 'JDN']);
        $kd = Agency::updateOrCreate(['id' => 2], ['name' => 'Kementerian Digital', 'acronym' => 'KD']);
        $nacsa = Agency::updateOrCreate(['id' => 6], ['name' => 'NACSA']);

        $p1 = Pillar::updateOrCreate(['pillar_number' => 1], ['name' => 'ENHANCE', 'full_title' => 'Public Sector Transformation']);
        $cs1 = CloudStack::create(['pillar_id' => $p1->id, 'stack_number' => 1, 'title' => 'Centralised Government Cloud Infrastructure']);

        // Example Activity
        $ap = ActionPlan::create([
            'cloud_stack_id' => $cs1->id,
            'lead_agency_id' => $jdn->id,
            'activity' => "Execute mandatory 'Cloud-First' Policy",
            'start_year' => 2026,
            'end_year' => 2030,
            'implementation_status' => 'initiated'
        ]);

        // Link multiple supporting agencies
        $ap->supportingAgencies()->attach([$kd->id, $nacsa->id]);

        // Load the parsed PDF data
        $this->call(PDFDataSeeder::class);
    }
}