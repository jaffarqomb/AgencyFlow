# AgencyFlow

AgencyFlow is a modern operations platform for creative and digital agencies. It brings project delivery, client collaboration, team operations, financial tracking, and AI-assisted business intelligence into one workspace.

The application is designed to help agencies move from the first client brief to final delivery with less administration and better visibility. Agency teams can manage projects, stages, tasks, deliverables, approvals, timesheets, expenses, invoices, payments, vendors, employees, teams, and departments from a single Filament-powered dashboard, while clients can follow progress through a dedicated portal.

## Core capabilities

- **Agency operations**: Manage clients, employees, teams, departments, vendors, services, and service categories.
- **Project delivery**: Organize projects into stages and tasks with owners, timelines, estimates, status, and delivery health.
- **Client collaboration**: Provide a client portal for project visibility, deliverables, versions, approvals, invoices, and payments.
- **Financial management**: Track quotations, invoices, invoice items, payments, expenses, budgets, expected profit, and project profitability.
- **Time and capacity tracking**: Record timesheets, hourly costs, overtime, team capacity, and employee utilization.
- **AI intelligence**: Store AI settings, risk predictions, analysis logs, project health scores, and profitability insights.
- **Authentication**: Use the Laravel Livewire starter-kit login and registration experience, with successful authentication leading to the Filament dashboard at `/admin`.
- **Filament administration**: Operate the back office through a Filament 5 panel with separate resource pages, form schemas, and table classes.

## Technology stack

- PHP 8.4
- Laravel 13
- Filament 5
- Livewire 4
- Flux UI
- Tailwind CSS 4
- SQLite by default
- Pest and PHPUnit for testing
- PHPStan and Laravel Pint for code quality

## Getting started

### Requirements

- PHP 8.4 or newer
- Composer
- Node.js and npm

### Installation

```bash
git clone https://github.com/jaffarqomb/AgencyFlow.git
cd AgencyFlow
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
```

For local development, run the Laravel application and frontend watcher with:

```bash
composer run dev
```

The default local database is SQLite. Update `.env` if you want to use another database connection.

## Application entry points

- `/` — AgencyFlow marketing landing page
- `/login` — Livewire authentication screen
- `/register` — Livewire registration screen
- `/admin` — Filament agency operations dashboard
- `/portal` — Client project portal

Unauthenticated users who open `/admin` are redirected to `/login`. After login or registration, users are redirected to the Filament dashboard.

## Seeded accounts

The database seeder creates demo users with the password `password`:

| Role | Email |
| --- | --- |
| Super admin | `admin@agencyflow.ai` |
| Agency owner | `owner@agencyflow.ai` |
| Project manager | `pm@agencyflow.ai` |
| Finance manager | `finance@agencyflow.ai` |
| Employee | `designer@agencyflow.ai` |
| Client portal user | `client@horizon.com` |

Do not use these credentials in a production environment.

## Development checks

Run the focused test suite with:

```bash
php artisan test --compact
```

Format changed PHP files with:

```bash
vendor/bin/pint --dirty --format agent
```

Run static analysis with:

```bash
vendor/bin/phpstan analyse --memory-limit=512M
```

## Project structure

```text
app/
├── Filament/          # Filament 5 resources, pages, schemas, tables, and widgets
├── Http/              # HTTP middleware and application concerns
├── Livewire/          # Livewire actions, settings, and application components
├── Models/            # Agency, project, financial, and AI domain models
└── Services/          # Application services such as AI and profitability analysis

database/
├── factories/         # Model factories
├── migrations/        # Database schema
└── seeders/           # Demo and development data

resources/
├── css/               # Tailwind CSS entry point
├── js/                # Vite JavaScript entry point
└── views/             # Blade, Livewire, Flux, and Filament views
```

## License

AgencyFlow is currently maintained as a private project. Add the project license here when it is ready for public distribution.
