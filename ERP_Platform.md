Act as a Senior Enterprise Solution Architect, ERP Architect, Laravel Expert, FilamentPHP Expert, Database Architect, UI/UX Designer, AI System Architect, Product Owner, and Technical Lead.

Your goal is to design and build a scalable enterprise-grade AI-Powered Creative Agency ERP Platform with a premium agency website and client portal.

====================================================
PRODUCT NAME
====================================================
AgencyFlow AI ERP is a comprehensive, enterprise-grade, AI-powered Creative Agency Management Platform designed specifically for branding, marketing, creative, design, content production, and digital agencies.

The platform unifies project management, team collaboration, resource planning, financial management, client communication, profitability analysis, and artificial intelligence into a single centralized system. AgencyFlow enables agencies to manage the complete lifecycle of client engagements, from lead acquisition and proposal generation to project delivery, invoicing, and long-term brand cultivation.

Built using Laravel 13, FilamentPHP, Livewire, Alpine.js, Tailwind CSS, and MySQL, the platform is designed with scalability, modularity, and SaaS-readiness in mind.
====================================================
AGENCY PROFILE
====================================================

The agency specializes in:

IDENTIFY
- Brand Strategy
- Brand Naming

CREATE
- Branding
- Rebranding
- Packaging
- Brand Collaterals
- Product Design
- Product Branding
- Interior Branding
- Editorial Design

COMMUNICATE
- Launch Strategy
- Comms Direction
- Social Strategy
- Social Branding
- Content Creation
- Campaigns
- Production
- Animation
- 3D Visualization
- Creative Copywriting

CAPTURE
- Community Management
- Reporting & Analytics
- Brand Cultivation

====================================================
TECH STACK
====================================================

Backend:
- Laravel 13.x

Admin ERP:
- FilamentPHP v5.x

Frontend:
- Livewire v4.x
- AlpineJS v2.x
- TailwindCSS 4.3.x

Database:
- MySQL v9.x

Authentication:
- Laravel Sanctum
- Filament Shield

Authorization:
- RBAC
- Policies
- Permissions

Storage:
- AWS S3 Compatible

Cache:
- Redis

Queue:
- Redis Queue

Notifications:
- Email
- In-App Notifications
- SMS Ready
- WhatsApp Integration Ready

Deployment:
- Docker
- VPS Ready
- AWS Ready

Architecture:
- DDD (Domain Driven Design)
- Service Layer Pattern
- Repository Pattern
- Event Driven Architecture
- Modular Architecture

====================================================
MAIN OBJECTIVES
====================================================

Build an ERP capable of:

- CRM
- Project Management
- Team Management
- Task Management
- Timesheets
- Expense Tracking
- Overtime Management
- Vendor Management
- Deliverables Management
- Client Approval Workflows
- Invoicing
- Payments
- Resource Planning
- Profitability Analysis
- Reporting
- AI Assistant
- Predictive Analytics

====================================================
USER ROLES
====================================================

1. Super Admin
2. Agency Owner
3. Operations Manager
4. Finance Manager
5. Project Manager
6. Team Leader
7. Employee
8. Client Portal User

Implement:

- Role Based Access Control
- Granular Permissions
- Audit Logs

====================================================
MODULE 1
CLIENT MANAGEMENT
====================================================

Features:

- Client Profiles
- Contacts
- Companies
- Client Notes
- Client Documents
- Client Communication History

Fields:

- company_name
- industry
- contact_person
- email
- mobile
- phone
- website
- address
- vat_number
- status

Relationships:

Client
→ Projects
→ Invoices
→ Payments
→ Quotations

====================================================
MODULE 2
SERVICE MANAGEMENT
====================================================

Create Service Categories:

IDENTIFY
CREATE
COMMUNICATE
CAPTURE

Each service has:

- name
- description
- category
- estimated_hours
- estimated_cost
- estimated_duration

====================================================
MODULE 3
TEAM MANAGEMENT
====================================================

Create agency teams:

- Strategy Team
- Branding Team
- Packaging Team
- Content Team
- Social Team
- Animation Team
- Production Team
- Development Team

Track:

- capacity
- utilization
- availability
- workload

====================================================
MODULE 4
EMPLOYEE MANAGEMENT
====================================================

Fields:

- employee_id
- full_name
- email
- mobile
- designation
- department
- hourly_rate
- overtime_rate
- joining_date
- status

Track:

- productivity
- utilization
- overtime
- project allocation

====================================================
MODULE 5
PROJECT MANAGEMENT
====================================================

Fields:

- project_code
- project_name
- client_id
- project_manager_id
- budget
- expected_profit
- planned_start_date
- planned_end_date
- actual_start_date
- actual_end_date
- status

Status:

- Draft
- Planning
- Active
- On Hold
- Completed
- Cancelled

Project contains:

- Services
- Stages
- Tasks
- Expenses
- Teams
- Deliverables
- Invoices

====================================================
MODULE 6
PROJECT STAGES
====================================================

Brand Strategy:

- Discovery
- Research
- Workshop
- Positioning
- Report
- Approval

Branding:

- Discovery
- Moodboard
- Concepts
- Logo Design
- Identity System
- Guidelines
- Approval

Packaging:

- Research
- Concepts
- Dieline
- Design
- Mockup
- Production Files
- Approval

Social Branding:

- Research
- Content Strategy
- Creative Direction
- Templates
- Approval

====================================================
MODULE 7
TASK MANAGEMENT
====================================================

Fields:

- title
- description
- assigned_to
- priority
- start_date
- due_date
- estimated_hours
- actual_hours
- status

Status:

- Pending
- In Progress
- Review
- Completed
- Cancelled

====================================================
MODULE 8
TIMESHEET MANAGEMENT
====================================================

Track:

- employee
- project
- stage
- task
- date
- hours
- notes

Automatically calculate labor cost.

====================================================
MODULE 9
OVERTIME MANAGEMENT
====================================================

Track:

- overtime_hours
- overtime_rate
- overtime_cost

Formula:

Overtime Cost =
Hours × Overtime Rate

Automatically update project costs.

====================================================
MODULE 10
PROJECT EXTENSION REQUESTS
====================================================

Extension Workflow:

Employee
→ Team Lead
→ Project Manager
→ Finance
→ Approval

Fields:

- project
- stage
- requested_by
- current_deadline
- new_deadline
- reason
- extra_hours
- extra_cost

When approved:

Automatically:

- Update project timeline
- Update expenses
- Recalculate profitability

====================================================
MODULE 11
EXPENSE MANAGEMENT
====================================================

Expense Categories:

- Personnel
- Overtime
- Vendors
- Freelancers
- Production
- Software
- Advertising
- Printing
- Transportation
- Travel
- Administration

Features:

- Expense Tracking
- Approval Workflow
- Attach Receipts
- Project Cost Allocation

====================================================
MODULE 12
VENDOR MANAGEMENT
====================================================

Track:

- vendors
- suppliers
- freelancers
- contractors

Fields:

- company_name
- service_type
- contact_person
- email
- phone

====================================================
MODULE 13
DELIVERABLE MANAGEMENT
====================================================

Track:

- versions
- approvals
- files
- submission dates

Statuses:

- Draft
- Internal Review
- Client Review
- Approved
- Delivered

====================================================
MODULE 14
CLIENT APPROVALS
====================================================

Workflow:

Draft
→ Internal Review
→ Client Review
→ Changes Requested
→ Approved
→ Delivered

====================================================
MODULE 15
INVOICING & PAYMENTS
====================================================

Features:

- Quotations
- Invoices
- Payment Schedules
- Receipts

Track:

- deposits
- milestone payments
- final payments

====================================================
MODULE 16
PROFITABILITY ENGINE
====================================================

Formula:

Profit =
Revenue
- Labor Cost
- Overtime Cost
- Vendor Cost
- Expenses

Calculate:

- Gross Profit
- Net Profit
- Margin %

====================================================
MODULE 17
ALERTS & NOTIFICATIONS
====================================================

Generate alerts for:

1. Timeline Extension Requests
2. Overtime Detected
3. Budget Threshold Exceeded
4. Reduced Profit Margin
5. Overdue Tasks
6. Resource Conflicts
7. Vendor Cost Overruns
8. Client Revision Limits Exceeded

Budget Alerts:

70%
80%
90%
100%

Notify:

- Project Manager
- Finance Manager
- Agency Owner

====================================================
MODULE 18
DASHBOARDS
====================================================

Agency Owner Dashboard

Display:

- Revenue
- Expenses
- Profit
- Overtime Cost
- Active Projects
- Project Health
- Forecast Revenue

Project Manager Dashboard

Display:

- Project Progress
- Stage Progress
- Budget Consumed
- Tasks Due
- Team Allocation

Finance Dashboard

Display:

- Outstanding Invoices
- Expenses
- Cash Flow
- Profitability

====================================================
MODULE 19
REPORTING ENGINE
====================================================

Generate:

- Project Profitability
- Team Utilization
- Resource Allocation
- Expense Analysis
- Revenue Reports
- Overtime Reports
- Client Reports
- Vendor Reports

Export:

- Excel
- PDF

====================================================
MODULE 20
CLIENT PORTAL
====================================================

Clients can:

- View Projects
- Review Deliverables
- Approve Work
- Download Files
- View Invoices
- Make Payments
- View Progress

====================================================
MODULE 21
AI INTELLIGENCE ENGINE
====================================================

Create a dedicated AI Intelligence Layer.

Architecture:

AI Layer
│
├── Risk Prediction Engine
├── Cost Estimation Engine
├── Resource Planning Engine
├── Health Score Engine
├── Profit Forecasting Engine
├── Content Cost Calculator
├── Proposal Generator
├── Scope Change Detection
├── Sentiment Analysis
└── Quotation Builder

====================================================
AI MODULE 1
PROJECT RISK PREDICTION
====================================================

Predict:

- Budget Risk
- Timeline Risk
- Resource Risk
- Client Risk
- Approval Risk

Provide:

- Risk Level
- Probability Score
- Recommendations

====================================================
AI MODULE 2
COST ESTIMATION
====================================================

Estimate:

- Project Cost
- Required Hours
- Resource Requirements
- Profitability

Based on:

- Historical Data
- Service Types
- Team Size
- Deliverables

====================================================
AI MODULE 3
RESOURCE PLANNING
====================================================

Recommend:

- Best Team Allocation
- Available Resources
- Workload Distribution

Predict:

- Overutilization
- Overtime Risks

====================================================
AI MODULE 4
PROJECT HEALTH SCORE
====================================================

Score Components:

- Budget Health
- Timeline Health
- Client Satisfaction
- Resource Health
- Progress Health
- Profitability

Score:

0-100

====================================================
AI MODULE 5
PROFIT FORECASTING
====================================================

Predict:

- Final Cost
- Final Revenue
- Expected Profit
- Margin %

Issue warnings when profitability declines.

====================================================
AI MODULE 6
CONTENT PRODUCTION COST CALCULATOR
====================================================

Estimate costs for:

- Social Media
- Photography
- Video
- Animation
- Motion Graphics
- Copywriting
- Campaigns
- 3D Visualization

====================================================
AI MODULE 7
AI PROPOSAL GENERATOR
====================================================

Generate:

- Executive Summary
- Scope
- Deliverables
- Timeline
- Investment
- Terms

Export:

- PDF
- Word

====================================================
AI MODULE 8
AI SCOPE CHANGE DETECTION
====================================================

Detect:

- Additional Deliverables
- Extra Revisions
- Timeline Expansion
- New Requirements

Generate:

- Change Orders
- Additional Cost Analysis

====================================================
AI MODULE 9
CLIENT SENTIMENT ANALYSIS
====================================================

Analyze:

- Emails
- Comments
- Feedback
- Notes

Detect:

- Positive
- Neutral
- Negative
- Frustrated
- High Risk

====================================================
AI MODULE 10
CLIENT QUOTATION BUILDER
====================================================

Generate:

- Professional Quotations
- Service Breakdown
- Payment Schedule
- Scope Definition

Output:

- PDF
- Digital Approval Link
- Electronic Signature Ready

====================================================
AI COPILOT ASSISTANT
====================================================

Users can ask:

- Show projects at risk
- Forecast next month revenue
- Generate proposal
- Analyze profitability
- Explain budget overruns
- Predict resource shortages
- Generate executive reports

Support:

- OpenAI
- Azure OpenAI
- Claude
- Gemini
- Ollama
- DeepSeek

Create AI Provider Abstraction Layer:

- AIProviderInterface
- OpenAIProvider
- ClaudeProvider
- GeminiProvider
- OllamaProvider
- DeepSeekProvider

====================================================
AI ADMIN SETTINGS
====================================================

Configure:

- Provider
- API Keys
- Models
- Prompt Templates
- Usage Limits
- Cost Tracking
- Token Monitoring

====================================================
PREMIUM AGENCY WEBSITE
====================================================

Create a stunning award-winning website.

Inspired By:

- Pentagram
- Collins
- Landor
- Interbrand
- Mucho

Pages:

- Home
- About
- Services
- Projects
- Case Studies
- Team
- Careers
- Blog
- Contact

====================================================
WEBSITE SECTIONS
====================================================

Home:

- Hero
- Services
- Featured Work
- Portfolio
- Testimonials
- Case Studies
- Process
- Team
- CTA

Features:

- Dark Luxury Design
- Premium Animations
- AlpineJS Interactions
- Parallax Effects
- Interactive Portfolio
- SEO Optimization
- Mobile First Design

====================================================
DATABASE DESIGN
====================================================

Generate:

- Complete ERD
- Database Schema
- Migrations
- Factories
- Seeders
- Relationships

====================================================
LARAVEL IMPLEMENTATION
====================================================

Generate:

- Models
- Controllers
- Services
- Repositories
- Policies
- Events
- Listeners
- Notifications
- Filament Resources
- Widgets
- Dashboards

====================================================
DELIVERABLES REQUIRED
====================================================

Generate in order:

1. System Architecture
2. Domain Model
3. Complete ERD
4. Database Schema
5. Module Breakdown
6. User Stories
7. Use Cases
8. Laravel Folder Structure
9. Filament Resource Plan
10. UI Wireframes
11. Dashboard Design
12. Development Roadmap
13. Sprint Plan
14. Deployment Architecture
15. Testing Strategy
16. SaaS Multi-Tenant Readiness
17. Security Architecture
18. Production-Ready Implementation Plan

Build the solution as an enterprise-grade SaaS-ready AI-powered Creative Agency ERP platform with scalability, maintainability, clean architecture, modern UX, and future AI expansion in mind.