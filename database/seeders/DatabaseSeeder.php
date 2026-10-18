<?php

namespace Database\Seeders;

use App\Models\AIRiskPrediction;
use App\Models\AISetting;
use App\Models\Client;
use App\Models\ClientApproval;
use App\Models\Deliverable;
use App\Models\DeliverableVersion;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Task;
use App\Models\Team;
use App\Models\Timesheet;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users & Roles
        $adminUser = User::updateOrCreate(['email' => 'admin@agencyflow.ai'], [
            'name' => 'Alexander Vance',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'active',
            'phone' => '+1 (555) 010-9900',
            'email_verified_at' => now(),
        ]);

        $ownerUser = User::updateOrCreate(['email' => 'owner@agencyflow.ai'], [
            'name' => 'Elena Rostova',
            'password' => Hash::make('password'),
            'role' => 'agency_owner',
            'status' => 'active',
            'phone' => '+1 (555) 010-9901',
            'email_verified_at' => now(),
        ]);

        $pmUser = User::updateOrCreate(['email' => 'pm@agencyflow.ai'], [
            'name' => 'Marcus Sterling',
            'password' => Hash::make('password'),
            'role' => 'project_manager',
            'status' => 'active',
            'phone' => '+1 (555) 010-9902',
            'email_verified_at' => now(),
        ]);

        $financeUser = User::updateOrCreate(['email' => 'finance@agencyflow.ai'], [
            'name' => 'Sophia Chen',
            'password' => Hash::make('password'),
            'role' => 'finance_manager',
            'status' => 'active',
            'phone' => '+1 (555) 010-9903',
            'email_verified_at' => now(),
        ]);

        $designerUser = User::updateOrCreate(['email' => 'designer@agencyflow.ai'], [
            'name' => 'Julian Drake',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'status' => 'active',
            'phone' => '+1 (555) 010-9904',
            'email_verified_at' => now(),
        ]);

        $clientUser = User::updateOrCreate(['email' => 'client@horizon.com'], [
            'name' => 'Charlotte Dubois',
            'password' => Hash::make('password'),
            'role' => 'client_portal_user',
            'status' => 'active',
            'phone' => '+1 (555) 010-8801',
            'email_verified_at' => now(),
        ]);

        // 2. Service Categories & 4-Pillar Services
        $categoriesData = [
            'IDENTIFY' => [
                'description' => 'Brand Strategy, Market Discovery, and Naming Foundations',
                'services' => [
                    ['name' => 'Brand Strategy', 'hours' => 40, 'cost' => 4500, 'duration' => '3 weeks'],
                    ['name' => 'Brand Naming', 'hours' => 25, 'cost' => 3000, 'duration' => '2 weeks'],
                    ['name' => 'Market Positioning & Audit', 'hours' => 30, 'cost' => 3800, 'duration' => '2 weeks'],
                ],
            ],
            'CREATE' => [
                'description' => 'Visual Identity, Packaging, Industrial & Editorial Design',
                'services' => [
                    ['name' => 'Branding & Visual Identity', 'hours' => 60, 'cost' => 8500, 'duration' => '4 weeks'],
                    ['name' => 'Rebranding', 'hours' => 80, 'cost' => 11000, 'duration' => '6 weeks'],
                    ['name' => 'Packaging Design', 'hours' => 50, 'cost' => 6500, 'duration' => '4 weeks'],
                    ['name' => 'Brand Collaterals', 'hours' => 30, 'cost' => 3500, 'duration' => '2 weeks'],
                    ['name' => 'Product Design', 'hours' => 70, 'cost' => 9500, 'duration' => '5 weeks'],
                    ['name' => 'Product Branding', 'hours' => 45, 'cost' => 6000, 'duration' => '3 weeks'],
                    ['name' => 'Interior Branding', 'hours' => 60, 'cost' => 7500, 'duration' => '4 weeks'],
                    ['name' => 'Editorial Design', 'hours' => 40, 'cost' => 4500, 'duration' => '3 weeks'],
                ],
            ],
            'COMMUNICATE' => [
                'description' => 'Launch Campaigns, 3D Renders, Social Strategy & Animation',
                'services' => [
                    ['name' => 'Launch Strategy', 'hours' => 35, 'cost' => 4500, 'duration' => '3 weeks'],
                    ['name' => 'Comms Direction', 'hours' => 30, 'cost' => 4000, 'duration' => '2 weeks'],
                    ['name' => 'Social Strategy', 'hours' => 30, 'cost' => 3500, 'duration' => '2 weeks'],
                    ['name' => 'Social Branding', 'hours' => 40, 'cost' => 5000, 'duration' => '3 weeks'],
                    ['name' => 'Content Creation', 'hours' => 40, 'cost' => 4500, 'duration' => '3 weeks'],
                    ['name' => 'Omnichannel Campaigns', 'hours' => 60, 'cost' => 8000, 'duration' => '4 weeks'],
                    ['name' => 'Commercial Production', 'hours' => 80, 'cost' => 12500, 'duration' => '5 weeks'],
                    ['name' => 'Motion Graphics & Animation', 'hours' => 50, 'cost' => 7000, 'duration' => '3 weeks'],
                    ['name' => '3D Visualization & CGI', 'hours' => 45, 'cost' => 6500, 'duration' => '3 weeks'],
                    ['name' => 'Creative Copywriting', 'hours' => 25, 'cost' => 3000, 'duration' => '2 weeks'],
                ],
            ],
            'CAPTURE' => [
                'description' => 'Community Management, Analytics Reporting & Brand Cultivation',
                'services' => [
                    ['name' => 'Community Management', 'hours' => 40, 'cost' => 3500, 'duration' => 'Monthly'],
                    ['name' => 'Reporting & Analytics', 'hours' => 20, 'cost' => 2200, 'duration' => 'Monthly'],
                    ['name' => 'Brand Cultivation', 'hours' => 30, 'cost' => 3800, 'duration' => 'Ongoing'],
                ],
            ],
        ];

        $sort = 1;
        foreach ($categoriesData as $catName => $catDetails) {
            $category = ServiceCategory::updateOrCreate(['name' => $catName], [
                'slug' => strtolower($catName),
                'description' => $catDetails['description'],
                'sort_order' => $sort++,
            ]);

            foreach ($catDetails['services'] as $svc) {
                Service::updateOrCreate(['name' => $svc['name']], [
                    'category_id' => $category->id,
                    'slug' => Str::slug($svc['name']),
                    'estimated_hours' => $svc['hours'],
                    'estimated_cost' => $svc['cost'],
                    'estimated_duration' => $svc['duration'],
                    'is_active' => true,
                ]);
            }
        }

        // 3. Teams
        $teamsData = [
            'Strategy Team' => 'Brand architecture, positioning and market intelligence',
            'Branding Team' => 'Core visual identities, typography systems, and guidelines',
            'Packaging Team' => 'Dielines, structural prototyping, and luxury tactile finishes',
            'Content Team' => 'Creative copy, storytelling, and digital content assets',
            'Social Team' => 'Social media branding, templates, and social campaign activations',
            'Animation Team' => 'Motion design, title sequences, and 2D/3D digital motion',
            'Production Team' => 'Film shoots, sound design, and commercial production',
            'Development Team' => 'Interactive web platforms, design systems, and client portal tech',
        ];

        $createdTeams = [];
        foreach ($teamsData as $tName => $tDesc) {
            $createdTeams[$tName] = Team::updateOrCreate(['name' => $tName], [
                'slug' => Str::slug($tName),
                'description' => $tDesc,
                'lead_user_id' => $pmUser->id,
                'capacity_hours_per_week' => 160,
            ]);
        }

        // 4. Employees
        $designerEmployee = Employee::updateOrCreate(['email' => $designerUser->email], [
            'user_id' => $designerUser->id,
            'team_id' => $createdTeams['Branding Team']->id,
            'employee_id' => 'EMP-001',
            'full_name' => $designerUser->name,
            'mobile' => $designerUser->phone,
            'designation' => 'Lead Brand Identity Designer',
            'department' => 'Creative Design',
            'hourly_rate' => 85.00,
            'overtime_rate' => 127.50,
            'joining_date' => now()->subMonths(18),
            'status' => 'active',
        ]);

        $pmEmployee = Employee::updateOrCreate(['email' => $pmUser->email], [
            'user_id' => $pmUser->id,
            'team_id' => $createdTeams['Strategy Team']->id,
            'employee_id' => 'EMP-002',
            'full_name' => $pmUser->name,
            'mobile' => $pmUser->phone,
            'designation' => 'Senior Project Director',
            'department' => 'Operations & Delivery',
            'hourly_rate' => 95.00,
            'overtime_rate' => 142.50,
            'joining_date' => now()->subMonths(24),
            'status' => 'active',
        ]);

        // 5. Vendors
        $printVendor = Vendor::updateOrCreate(['company_name' => 'LuxPrint Packaging Lab'], [
            'service_type' => 'Luxury Packaging & Foil Stamping',
            'contact_person' => 'David Krauss',
            'email' => 'orders@luxprint.io',
            'phone' => '+1 (555) 789-0123',
            'address' => '450 Industrial Parkway, Brooklyn, NY',
            'rating' => 5,
            'status' => 'active',
            'notes' => 'Preferred vendor for high-end dieline embossing and FSC certified papers.',
        ]);

        $renderVendor = Vendor::updateOrCreate(['company_name' => 'RenderCraft 3D Studio'], [
            'service_type' => 'Photorealistic 3D CGI & Product Renders',
            'contact_person' => 'Marta Vane',
            'email' => 'studio@rendercraft.cg',
            'phone' => '+1 (555) 789-0124',
            'rating' => 5,
            'status' => 'active',
            'notes' => 'Exceptional turn-around on octane and redshift animations.',
        ]);

        // 6. Clients
        $clientHorizon = Client::updateOrCreate(['email' => 'contact@horizon-ev.com'], [
            'company_name' => 'Horizon Luxury EV',
            'industry' => 'Automotive & Clean Energy',
            'contact_person' => 'Charlotte Dubois',
            'mobile' => '+1 (555) 010-8801',
            'website' => 'https://horizon-ev.example.com',
            'address' => '100 Silicon Way, Palo Alto, CA 94304',
            'vat_number' => 'US-983421098',
            'status' => 'active',
            'notes' => 'Tier-1 client. High expectation on minimalist Scandinavian aesthetic.',
            'portal_user_id' => $clientUser->id,
        ]);

        $clientAethelgard = Client::updateOrCreate(['email' => 'hello@aethelgard-spirits.com'], [
            'company_name' => 'Aethelgard Botanical Spirits',
            'industry' => 'Luxury Beverage & Distilleries',
            'contact_person' => 'Magnus Lindholm',
            'mobile' => '+1 (555) 010-8802',
            'website' => 'https://aethelgard.example.com',
            'address' => '78 Fjord Avenue, Seattle, WA 98101',
            'vat_number' => 'US-774411990',
            'status' => 'active',
            'notes' => 'Boutique single-origin gin distillery expanding to international duty-free markets.',
        ]);

        // 7. Projects & Stages
        $project1 = Project::updateOrCreate(['project_code' => 'PRJ-2026-001'], [
            'project_name' => 'Horizon EV Global Brand Identity & Launch',
            'client_id' => $clientHorizon->id,
            'project_manager_id' => $pmUser->id,
            'budget' => 95000.00,
            'expected_profit' => 38000.00,
            'planned_start_date' => now()->subMonths(2),
            'planned_end_date' => now()->addMonths(2),
            'actual_start_date' => now()->subMonths(2),
            'status' => 'active',
            'health_score' => 94.50,
            'currency' => 'USD',
            'description' => 'Complete corporate rebranding, custom bespoke typography, 3D visual language, and digital launch campaign.',
        ]);

        // Add services to project
        $brandingService = Service::where('name', 'Branding & Visual Identity')->first();
        $strategyService = Service::where('name', 'Brand Strategy')->first();
        $visualizationService = Service::where('name', '3D Visualization & CGI')->first();

        if ($brandingService) {
            $project1->services()->syncWithoutDetaching([
                $brandingService->id => ['estimated_hours' => 60, 'agreed_price' => 25000.00],
            ]);
        }
        if ($strategyService) {
            $project1->services()->syncWithoutDetaching([
                $strategyService->id => ['estimated_hours' => 40, 'agreed_price' => 18000.00],
            ]);
        }
        if ($visualizationService) {
            $project1->services()->syncWithoutDetaching([
                $visualizationService->id => ['estimated_hours' => 45, 'agreed_price' => 20000.00],
            ]);
        }

        // Stages for Project 1
        $stages = [
            ['name' => 'Discovery & Brand Audit', 'sort' => 1, 'status' => 'completed', 'completed_at' => now()->subDays(45)],
            ['name' => 'Brand Strategy & Positioning', 'sort' => 2, 'status' => 'completed', 'completed_at' => now()->subDays(30)],
            ['name' => 'Moodboards & Visual Direction', 'sort' => 3, 'status' => 'completed', 'completed_at' => now()->subDays(15)],
            ['name' => 'Logo & Identity System', 'sort' => 4, 'status' => 'in_progress', 'completed_at' => null],
            ['name' => '3D Concept Visualization', 'sort' => 5, 'status' => 'pending', 'completed_at' => null],
            ['name' => 'Brand Guidelines & Design System', 'sort' => 6, 'status' => 'pending', 'completed_at' => null],
            ['name' => 'Global Launch Campaign Assets', 'sort' => 7, 'status' => 'pending', 'completed_at' => null],
        ];

        $createdStages = [];
        foreach ($stages as $stg) {
            $createdStages[$stg['name']] = ProjectStage::updateOrCreate([
                'project_id' => $project1->id,
                'name' => $stg['name'],
            ], [
                'sort_order' => $stg['sort'],
                'status' => $stg['status'],
                'start_date' => now()->subDays(60 - ($stg['sort'] * 8)),
                'due_date' => now()->addDays($stg['sort'] * 12),
                'completed_at' => $stg['completed_at'],
            ]);
        }

        // 8. Tasks & Timesheets
        $task1 = Task::updateOrCreate([
            'project_id' => $project1->id,
            'title' => 'Design Primary Monogram and Responsive Wordmark',
        ], [
            'stage_id' => $createdStages['Logo & Identity System']->id,
            'assigned_to' => $designerEmployee->id,
            'description' => 'Vector geometric exploration balancing automotive aerodynamics with luxury prestige.',
            'priority' => 'high',
            'start_date' => now()->subDays(10),
            'due_date' => now()->addDays(4),
            'estimated_hours' => 32.0,
            'actual_hours' => 24.5,
            'status' => 'in_progress',
        ]);

        Timesheet::updateOrCreate([
            'employee_id' => $designerEmployee->id,
            'project_id' => $project1->id,
            'task_id' => $task1->id,
            'date' => now()->subDays(2)->toDateString(),
        ], [
            'stage_id' => $createdStages['Logo & Identity System']->id,
            'hours' => 8.0,
            'labor_cost' => 680.00,
            'notes' => 'Explored 3 direction variations for the primary front-grille badge emblem.',
            'status' => 'approved',
        ]);

        Timesheet::updateOrCreate([
            'employee_id' => $designerEmployee->id,
            'project_id' => $project1->id,
            'task_id' => $task1->id,
            'date' => now()->subDays(1)->toDateString(),
        ], [
            'stage_id' => $createdStages['Logo & Identity System']->id,
            'hours' => 7.5,
            'labor_cost' => 637.50,
            'notes' => 'Refined optical kerning and light/dark mode chromatic adjustments.',
            'status' => 'approved',
        ]);

        // 9. Deliverables & Client Approvals
        $deliverable1 = Deliverable::updateOrCreate([
            'project_id' => $project1->id,
            'title' => 'Horizon EV Core Identity Deck (V1)',
        ], [
            'stage_id' => $createdStages['Logo & Identity System']->id,
            'description' => 'Complete presentation featuring 3 identity routes, typography hierarchy, and UI vehicle display mockup.',
            'current_status' => 'client_review',
            'due_date' => now()->addDays(5),
        ]);

        $v1 = DeliverableVersion::updateOrCreate([
            'deliverable_id' => $deliverable1->id,
            'version_number' => 1,
        ], [
            'file_path' => 'deliverables/horizon-v1-identity.pdf',
            'preview_url' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=1200&q=80',
            'notes' => 'Includes route A (Minimal Nordic) and route B (Kinetic Electric).',
            'uploaded_by' => $pmUser->id,
        ]);

        ClientApproval::updateOrCreate([
            'deliverable_id' => $deliverable1->id,
            'deliverable_version_id' => $v1->id,
        ], [
            'client_user_id' => $clientUser->id,
            'decision' => 'approved',
            'feedback_comments' => 'Route A is stunning! The balance between modern minimalism and automotive presence is world-class.',
            'signature_hash' => hash('sha256', 'Horizon-Approval-2026-v1'),
            'actioned_at' => now()->subHours(6),
        ]);

        // 10. Financials: Quotation, Invoice, Expenses
        $quotation = Quotation::updateOrCreate(['quotation_number' => 'Q-2026-001'], [
            'client_id' => $clientHorizon->id,
            'project_id' => $project1->id,
            'title' => 'Global Rebranding & Launch SOW',
            'subtotal' => 95000.00,
            'tax_rate' => 0.00,
            'tax_amount' => 0.00,
            'total' => 95000.00,
            'status' => 'accepted',
            'valid_until' => now()->addMonths(3),
            'scope_summary' => 'Brand Strategy, Visual Identity, 3D Assets and Worldwide Launch Collaterals.',
        ]);

        QuotationItem::updateOrCreate([
            'quotation_id' => $quotation->id,
            'item_description' => 'Phase 1: Brand Strategy & Comprehensive Identity System',
        ], [
            'quantity' => 1,
            'unit_price' => 50000.00,
            'total_price' => 50000.00,
        ]);

        QuotationItem::updateOrCreate([
            'quotation_id' => $quotation->id,
            'item_description' => 'Phase 2: 3D Visualization, Motion Assets & Campaign Direction',
        ], [
            'quantity' => 1,
            'unit_price' => 45000.00,
            'total_price' => 45000.00,
        ]);

        $invoice1 = Invoice::updateOrCreate(['invoice_number' => 'INV-2026-001'], [
            'client_id' => $clientHorizon->id,
            'project_id' => $project1->id,
            'quotation_id' => $quotation->id,
            'issue_date' => now()->subDays(30),
            'due_date' => now()->subDays(15),
            'subtotal' => 47500.00,
            'tax_rate' => 0.00,
            'tax_amount' => 0.00,
            'total' => 47500.00,
            'amount_paid' => 47500.00,
            'status' => 'paid',
            'notes' => '50% Initial Deposit for Brand Strategy and Creative Discovery.',
        ]);

        InvoiceItem::updateOrCreate([
            'invoice_id' => $invoice1->id,
            'item_description' => 'Deposit Payment: Project Inception and Stage 1-3 Deliverables',
        ], [
            'quantity' => 1,
            'unit_price' => 47500.00,
            'total_price' => 47500.00,
        ]);

        Payment::updateOrCreate(['payment_reference' => 'PAY-2026-001'], [
            'invoice_id' => $invoice1->id,
            'amount' => 47500.00,
            'payment_date' => now()->subDays(20),
            'payment_method' => 'bank_transfer',
            'payment_type' => 'deposit',
            'notes' => 'Wire transfer received via JPMorgan Chase.',
        ]);

        Expense::updateOrCreate([
            'project_id' => $project1->id,
            'receipt_path' => 'receipts/render-3d-deposit.pdf',
        ], [
            'vendor_id' => $renderVendor->id,
            'category' => 'vendors',
            'amount' => 3500.00,
            'expense_date' => now()->subDays(12),
            'notes' => '3D vehicle mesh preparation and lighting study studio fee.',
            'status' => 'approved',
        ]);

        // 11. AI Settings & Predictive Risk
        AISetting::updateOrCreate(['provider' => 'openai'], [
            'api_key' => env('OPENAI_API_KEY'),
            'model_name' => 'gpt-4o',
            'is_active' => true,
            'temperature' => 0.70,
            'max_tokens' => 2048,
            'monthly_budget_usd' => 250.00,
            'total_spent_usd' => 12.45,
        ]);

        AISetting::updateOrCreate(['provider' => 'claude'], [
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model_name' => 'claude-3-5-sonnet-20241022',
            'is_active' => false,
            'temperature' => 0.70,
            'max_tokens' => 2048,
        ]);

        AIRiskPrediction::updateOrCreate([
            'project_id' => $project1->id,
            'risk_type' => 'budget',
        ], [
            'risk_level' => 'low',
            'probability_score' => 12.50,
            'recommendations' => [
                'Project financial velocity is healthy; burn rate is currently at 34% with 50% project milestones achieved.',
                'Deliverable approvals have been executed in under 24 hours, mitigating turnaround bottleneck risk.',
            ],
            'evaluated_at' => now(),
        ]);
    }
}
