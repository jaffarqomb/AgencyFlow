<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ProfitabilityChartWidget extends ChartWidget
{
    protected ?string $heading = 'Revenue vs. Cost & Net Margin Cadence';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Invoiced Revenue ($)',
                    'data' => [42000, 58000, 71000, 85000, 92000, 114000],
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'borderColor' => '#10B981',
                ],
                [
                    'label' => 'Total Labor & Vendor Cost ($)',
                    'data' => [18000, 24000, 29000, 34000, 39000, 48000],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => '#EF4444',
                ],
                [
                    'label' => 'Net Agency Profit ($)',
                    'data' => [24000, 34000, 42000, 51000, 53000, 66000],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'borderColor' => '#3B82F6',
                ],
            ],
            'labels' => ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
