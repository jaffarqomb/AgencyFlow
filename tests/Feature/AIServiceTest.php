<?php

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\User;
use App\Services\AI\AIService;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'agency_owner',
        'status' => 'active',
    ]);

    $this->client = Client::create([
        'company_name' => 'Apex NeuroSystems',
        'contact_person' => 'Sarah Connor',
        'email' => 'sarah@apex.test',
        'status' => 'active',
    ]);

    $this->project = Project::create([
        'project_code' => 'PRJ-AI-001',
        'project_name' => 'Apex Rebranding',
        'client_id' => $this->client->id,
        'budget' => 60000.00,
        'status' => 'active',
        'health_score' => 95.0,
    ]);

    ProjectStage::create([
        'project_id' => $this->project->id,
        'name' => 'Brand Audit',
        'sort_order' => 1,
        'status' => 'completed',
    ]);

    ProjectStage::create([
        'project_id' => $this->project->id,
        'name' => 'Visual Exploration',
        'sort_order' => 2,
        'status' => 'in_progress',
    ]);
});

test('ai service accurately predicts risk and generates recommendations', function () {
    $aiService = new AIService;
    $risk = $aiService->predictAndPersistRisk($this->project);

    expect($risk)->toHaveKeys(['risk_level', 'probability_score', 'recommendations']);
    expect($risk['risk_level'])->toBeIn(['low', 'medium', 'high', 'critical']);
    expect($this->project->riskPredictions()->count())->toBeGreaterThanOrEqual(1);
});

test('ai service calculates composite health score and persists to project', function () {
    $aiService = new AIService;
    $health = $aiService->evaluateAndPersistHealth($this->project);

    expect($health)->toHaveKeys(['score', 'factors', 'summary']);
    expect($health['score'])->toBeGreaterThanOrEqual(0)->toBeLessThanOrEqual(100);
    expect($this->project->fresh()->health_score)->toEqual($health['score']);
});

test('ai service detects scope creep and calculates additional cost suggestions', function () {
    $aiService = new AIService;
    $clientFeedback = 'We love the direction, but we also need a complete 3D animated video and additional packaging dieline variations.';

    $scopeAnalysis = $aiService->detectScopeCreep($this->project, $clientFeedback);

    expect($scopeAnalysis['has_scope_change'])->toBeTrue();
    expect($scopeAnalysis['suggested_cost'])->toBeGreaterThan(0);
});

test('ai service generates structured executive proposal with timeline and scope', function () {
    $aiService = new AIService;
    $proposal = $aiService->generateProposal([
        'title' => 'Apex Cyber Security Rebrand',
        'budget' => 75000.00,
        'services' => ['Brand Strategy', 'Visual Identity', '3D Motion'],
    ]);

    expect($proposal['title'])->toContain('Apex Cyber Security Rebrand');
    expect($proposal['estimated_investment'])->toEqual(75000.00);
    expect($proposal['timeline_weeks'])->toEqual(8);
});

test('ai service calculates content production unit economics', function () {
    $aiService = new AIService;
    $cost = $aiService->calculateContentCost([
        'type' => 'video_production',
        'quantity' => 2,
    ]);

    expect($cost)->toHaveKeys(['estimated_hours', 'labor_cost', 'production_cost', 'total_cost', 'suggested_price']);
    expect($cost['total_cost'])->toBeGreaterThan(0);
    expect($cost['suggested_price'])->toBeGreaterThan($cost['total_cost']);
});
