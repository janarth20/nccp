<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\CloudStack;
use App\Models\ActionPlan;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch Pillars with nested Cloud Stacks and Action Plans [cite: 97, 162]
        $pillars = Pillar::with(['cloudStacks.actionPlans.agencies'])->get();

        // Dynamic counts for the Stats Cards [cite: 162]
        $stats = [
            'total_pillars' => $pillars->count(),
            'total_stacks' => CloudStack::count(),
            'total_plans' => ActionPlan::count(),
        ];

        return view('dashboard', compact('pillars', 'stats'));
    }
}