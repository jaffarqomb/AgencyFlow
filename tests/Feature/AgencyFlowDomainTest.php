<?php

use App\Models\Client;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectExtension;
use App\Models\ProjectStage;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Task;
use App\Models\Timesheet;
use App\Models\User;
use App\Services\ProfitabilityEngine;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'agency_owner',
        'status' => 'active',
    ]);

    $this->client = Client::create([
        'company_name' => 'Vanguard Luxury Design',
        'contact_person' => 'Elena Drake',
        'email' => 'elena@vanguard.example.com',
        'status' => 'active',
    ]);

    $this->employeeUser = User::create([
        'name' => 'David Vance',
        'email' => 'david.vance@agencyflow.test',
        'password' => Hash::make('password'),
        'role' => 'employee',
        'status' => 'active',
    ]);

    $this->department = Department::create([
        'name' => 'Creative',
        'slug' => 'creative',
        'is_active' => true,
    ]);

    $this->employee = Employee::create([
        'user_id' => $this->employeeUser->id,
        'department_id' => $this->department->id,
        'employee_id' => 'EMP-TEST-001',
        'full_name' => 'David Vance',
        'email' => 'david.vance@agencyflow.test',
        'designation' => 'Senior Visual Designer',
        'hourly_rate' => 80.00,
        'overtime_rate' => 120.00,
        'status' => 'active',
    ]);

    $this->project = Project::create([
        'project_code' => 'PRJ-TEST-001',
        'project_name' => 'Vanguard Brand System',
        'client_id' => $this->client->id,
        'project_manager_id' => $this->user->id,
        'budget' => 50000.00,
        'expected_profit' => 20000.00,
        'status' => 'active',
    ]);

    $this->stage = ProjectStage::create([
        'project_id' => $this->project->id,
        'name' => 'Visual Identity',
        'sort_order' => 1,
        'status' => 'in_progress',
        'start_date' => now()->toDateString(),
        'due_date' => now()->addDays(14)->toDateString(),
    ]);

    $this->task = Task::create([
        'project_id' => $this->project->id,
        'stage_id' => $this->stage->id,
        'assigned_to' => $this->employee->id,
        'title' => 'Logo Conceptualization',
        'priority' => 'high',
        'estimated_hours' => 20.0,
        'status' => 'in_progress',
    ]);
});

test('timesheet automatically calculates labor cost from employee hourly rate', function () {
    $timesheet = Timesheet::create([
        'employee_id' => $this->employee->id,
        'project_id' => $this->project->id,
        'stage_id' => $this->stage->id,
        'task_id' => $this->task->id,
        'date' => now()->toDateString(),
        'hours' => 5.0,
        'status' => 'approved',
    ]);

    expect((float) $timesheet->labor_cost)->toEqual(400.00); // 5.0 hours * $80/hr
});

test('project expected profit is calculated from its budget and selected service costs', function () {
    $category = ServiceCategory::create([
        'name' => 'Creative Services',
        'slug' => 'creative-services',
        'sort_order' => 1,
    ]);

    $brandStrategy = Service::create([
        'category_id' => $category->id,
        'name' => 'Brand Strategy',
        'slug' => 'brand-strategy',
        'estimated_cost' => 4500,
    ]);

    $packaging = Service::create([
        'category_id' => $category->id,
        'name' => 'Packaging Design',
        'slug' => 'packaging-design',
        'estimated_cost' => 6500,
    ]);

    $this->project->services()->sync([$brandStrategy->id, $packaging->id]);

    expect(Project::calculateExpectedProfitForServices(
        $this->project->budget,
        $this->project->services()->pluck('services.id')->all(),
    ))->toBe(39000.0);
});

test('project health score decreases for overdue and blocked work', function () {
    $healthyScore = $this->project->calculateHealthScore();

    $this->task->update([
        'status' => 'blocked',
        'due_date' => now()->subDay()->toDateString(),
    ]);
    $this->stage->update([
        'due_date' => now()->subDay()->toDateString(),
    ]);

    expect($this->project->calculateHealthScore())->toBeLessThan($healthyScore);
});

test('project financial calculations accurately aggregate costs and profit margins', function () {
    Timesheet::create([
        'employee_id' => $this->employee->id,
        'project_id' => $this->project->id,
        'stage_id' => $this->stage->id,
        'task_id' => $this->task->id,
        'date' => now()->toDateString(),
        'hours' => 10.0,
        'status' => 'approved',
    ]);

    $invoice = Invoice::create([
        'invoice_number' => 'INV-TEST-001',
        'client_id' => $this->client->id,
        'project_id' => $this->project->id,
        'issue_date' => now()->toDateString(),
        'due_date' => now()->addDays(30)->toDateString(),
        'subtotal' => 25000.00,
        'total' => 25000.00,
        'amount_paid' => 25000.00,
        'status' => 'paid',
    ]);

    InvoiceItem::create([
        'invoice_id' => $invoice->id,
        'item_description' => 'Stage 1 Inception',
        'quantity' => 1,
        'unit_price' => 25000.00,
        'total_price' => 25000.00,
    ]);

    $laborCost = $this->project->calculateLaborCost();
    expect($laborCost)->toEqual(800.00); // 10h * 80

    $profitabilityEngine = new ProfitabilityEngine;
    $profitability = $profitabilityEngine->calculateProjectProfitability($this->project);

    expect($profitability['revenue'])->toEqual(25000.00);
    expect($profitability['labor_cost'])->toEqual(800.00);
    expect($profitability['net_profit'])->toEqual(24200.00);
    expect($profitability['margin_percentage'])->toEqual(96.8);
});

test('project extension approval updates timeline and logs expenses', function () {
    $extension = ProjectExtension::create([
        'project_id' => $this->project->id,
        'stage_id' => $this->stage->id,
        'requested_by' => $this->user->id,
        'current_deadline' => now()->addDays(14)->toDateString(),
        'new_deadline' => now()->addDays(28)->toDateString(),
        'reason' => 'Client requested additional 3D packaging study.',
        'extra_hours' => 15.0,
        'extra_cost' => 1200.00,
        'status' => 'pending',
    ]);

    $extension->approve();

    expect($extension->fresh()->status)->toEqual('approved');
    expect($this->stage->fresh()->due_date->toDateString())->toEqual(now()->addDays(28)->toDateString());
    expect($this->project->expenses()->count())->toBeGreaterThanOrEqual(1);
});

test('invoice balances and payment reconciliations update correctly', function () {
    $invoice = Invoice::create([
        'invoice_number' => 'INV-TEST-002',
        'client_id' => $this->client->id,
        'project_id' => $this->project->id,
        'issue_date' => now()->toDateString(),
        'due_date' => now()->addDays(15)->toDateString(),
        'subtotal' => 10000.00,
        'total' => 10000.00,
        'amount_paid' => 0.00,
        'status' => 'sent',
    ]);

    InvoiceItem::create([
        'invoice_id' => $invoice->id,
        'item_description' => 'Milestone Deposit',
        'quantity' => 1,
        'unit_price' => 10000.00,
        'total_price' => 10000.00,
    ]);

    expect($invoice->remainingBalance())->toEqual(10000.00);

    Payment::create([
        'invoice_id' => $invoice->id,
        'payment_reference' => 'PAY-TEST-001',
        'amount' => 5000.00,
        'payment_date' => now()->toDateString(),
        'payment_method' => 'stripe',
        'payment_type' => 'milestone',
    ]);

    $invoice->refresh();
    expect($invoice->status)->toEqual('partially_paid');
    expect((float) $invoice->amount_paid)->toEqual(5000.00);
    expect($invoice->remainingBalance())->toEqual(5000.00);

    Payment::create([
        'invoice_id' => $invoice->id,
        'payment_reference' => 'PAY-TEST-002',
        'amount' => 5000.00,
        'payment_date' => now()->toDateString(),
        'payment_method' => 'stripe',
        'payment_type' => 'final',
    ]);

    $invoice->refresh();
    expect($invoice->status)->toEqual('paid');
    expect($invoice->remainingBalance())->toEqual(0.00);
});
