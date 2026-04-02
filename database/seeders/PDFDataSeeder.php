<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pillar;
use App\Models\CloudStack;
use App\Models\ActionPlan;
use App\Models\Agency;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PDFDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(base_path('nccp_data.json'));
        $data = json_decode($json, true);

        if (!$data || !isset($data['pillars'])) {
            $this->command->error("Invalid or missing nccp_data.json");
            return;
        }

        DB::transaction(function () use ($data) {
            foreach ($data['pillars'] as $pData) {
                // 1. Create or Update Pillar
                $pillar = Pillar::updateOrCreate(
                    ['pillar_number' => $pData['pillar_number']],
                    [
                        'name' => $pData['name'],
                        'full_title' => $pData['full_title']
                    ]
                );

                $this->command->info("Seeding Pillar: {$pillar->name}");

                foreach ($pData['cloud_stacks'] as $csData) {
                    // 2. Create or Update Cloud Stack
                    $cloudStack = CloudStack::updateOrCreate(
                        [
                            'pillar_id' => $pillar->id,
                            'stack_number' => $csData['stack_number']
                        ],
                        [
                            'title' => $csData['title']
                        ]
                    );

                    foreach ($csData['action_plans'] as $apData) {
                        // 3. Resolve Lead Agency
                        $leadAgencyId = null;
                        if (!empty($apData['lead_agency_acronym'])) {
                            $leadAgency = Agency::firstOrCreate(
                                ['acronym' => $apData['lead_agency_acronym']],
                                ['name' => $apData['lead_agency_acronym']] // Fallback name
                            );
                            $leadAgencyId = $leadAgency->id;
                        }

                        // 4. Create Action Plan
                        // Handle start/end year from duration string string like "2026-2030"
                        
                        $startYear = null;
                        $endYear = null;
                        if (!empty($apData['duration'])) {
                            preg_match('/(20\d{2}).*?(20\d{2})/', $apData['duration'], $matches);
                            if (count($matches) == 3) {
                                $startYear = $matches[1];
                                $endYear = $matches[2];
                            } elseif (preg_match('/(20\d{2})/', $apData['duration'], $matches)) {
                                $startYear = $matches[1];
                            }
                        }


                        $actionPlan = ActionPlan::create([
                            'cloud_stack_id' => $cloudStack->id,
                            'lead_agency_id' => $leadAgencyId,
                            'activity' => $apData['activity'],
                            'measurement_indicator' => $apData['measurement_indicator'],
                            'implementation_target' => $apData['implementation_target'],
                            'duration' => $apData['duration'],
                            'start_year' => $startYear,
                            'end_year' => $endYear,
                            'implementation_status' => 'pending' // Default
                        ]);

                        // 5. Attach Supporting Agencies
                        if (!empty($apData['supporting_agencies_acronyms'])) {
                            $supportIds = [];
                            // Ensure it's an array and filter out empty strings like ""
                            $acronyms = array_filter((array)$apData['supporting_agencies_acronyms']); 
                            
                            foreach ($acronyms as $acronym) {
                                // sometimes the PDF has comma separated strings instead of pure arrays
                                $parts = explode(',', $acronym);
                                foreach($parts as $part) {
                                    $cleanAcronym = trim($part);
                                    if(empty($cleanAcronym)) continue;

                                    $supportAgency = Agency::firstOrCreate(
                                        ['acronym' => $cleanAcronym],
                                        ['name' => $cleanAcronym]
                                    );
                                    $supportIds[] = $supportAgency->id;
                                }
                            }
                            if (!empty($supportIds)) {
                                $actionPlan->supportingAgencies()->attach($supportIds);
                            }
                        }
                    }
                }
            }
        });
        
        $this->command->info("PDF Data Seeding Complete!");
    }
}
