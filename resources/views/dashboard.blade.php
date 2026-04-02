@extends('layouts.app')

@section('content')
    <div class="row g-5 mb-10">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold">{{ $stats['total_pillars'] }}</div>
                    <div class="fw-semibold text-uppercase">Core Pillars [cite: 106]</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold">{{ $stats['total_stacks'] }}</div>
                    <div class="fw-semibold text-uppercase">Cloud Stacks [cite: 97]</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold">{{ $stats['total_plans'] }}</div>
                    <div class="fw-semibold text-uppercase">Action Plans [cite: 162]</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">NCCP Roadmap Hierarchy [cite: 126]</span>
                <span class="text-muted mt-1 fw-semibold fs-7">2026-2030 Horizon [cite: 57]</span>
            </h3>
        </div>
        <div class="card-body">
            @foreach($pillars as $pillar)
                <h4 class="mt-10 mb-4 text-primary">Pillar {{ $pillar->pillar_number }}: {{ $pillar->name }} [cite: 106]</h4>
                <div class="table-responsive">
                    <table class="table table-row-bordered table-row-gray-300 align-middle">
                        <thead class="bg-light">
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px ps-4">Stack [cite: 97]</th>
                                <th class="min-w-300px">Action Plans [cite: 124]</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pillar->cloudStacks as $stack)
                                <tr>
                                    <td class="ps-4 fw-bold">CS{{ $stack->stack_number }}: {{ $stack->title }} [cite: 167, 173]</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($stack->actionPlans as $plan)
                                                <li class="mb-2">
                                                    <i class="ki-duotone ki-check-circle text-success fs-3 me-2"></i>
                                                    {{ $plan->activity }} [cite: 174]
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection