<?php

namespace App\Filament\Widgets;

use App\Services\ProfitabilityEngine;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgencyStatsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $engine = app(ProfitabilityEngine::class);
        $overview = $engine->calculateAgencyOverview();

        $activeProjects = $overview['active_projects_count'];
        $revenue = number_format($overview['total_revenue'], 2);
        $netProfit = number_format($overview['total_profit'], 2);
        $overtime = number_format($overview['total_overtime'], 2);
        $margin = $overview['average_margin'];

        return [
            Stat::make('Total Invoiced Revenue', '$'.$revenue)
                ->description('YTD Agency Billings')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([15, 28, 42, 65, 80, 95])
                ->color('success'),

            Stat::make('Agency Net Profit', '$'.$netProfit)
                ->description("Blended Margin: {$margin}%")
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([10, 20, 30, 45, 60, 75])
                ->color('success'),

            Stat::make('Active Projects', (string) $activeProjects)
                ->description('Active across 4 pillars')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary'),

            Stat::make('Overtime Incurred', '$'.$overtime)
                ->description('Controlled labor cost impact')
                ->descriptionIcon('heroicon-m-fire')
                ->color($overview['total_overtime'] > 2000 ? 'danger' : 'warning'),
        ];
    }
}
