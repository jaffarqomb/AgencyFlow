<?php

namespace App\Services;

use App\Models\Project;

class ProfitabilityEngine
{
    /**
     * @return array{
     *     revenue: float,
     *     labor_cost: float,
     *     overtime_cost: float,
     *     vendor_cost: float,
     *     direct_expenses: float,
     *     total_cost: float,
     *     gross_profit: float,
     *     net_profit: float,
     *     margin_percentage: float,
     *     budget_consumed_percentage: float,
     *     budget_alert_threshold: int|null
     * }
     */
    public function calculateProjectProfitability(Project $project): array
    {
        $revenue = $project->calculateInvoicedRevenue();
        if ($revenue <= 0) {
            $revenue = (float) $project->budget;
        }

        $laborCost = $project->calculateLaborCost();
        $overtimeCost = $project->calculateOvertimeCost();
        $vendorCost = (float) $project->expenses()->whereNotNull('vendor_id')->where('status', 'approved')->sum('amount');
        $directExpenses = (float) $project->expenses()->whereNull('vendor_id')->where('status', 'approved')->sum('amount');

        $totalCost = $laborCost + $overtimeCost + $vendorCost + $directExpenses;
        $grossProfit = $revenue - ($laborCost + $overtimeCost + $vendorCost);
        $netProfit = $revenue - $totalCost;

        $marginPercentage = $revenue > 0 ? round(($netProfit / $revenue) * 100, 2) : 0.0;
        $budget = (float) $project->budget;
        $budgetConsumedPercentage = $budget > 0 ? round(($totalCost / $budget) * 100, 2) : 0.0;

        $alertThreshold = match (true) {
            $budgetConsumedPercentage >= 100 => 100,
            $budgetConsumedPercentage >= 90 => 90,
            $budgetConsumedPercentage >= 80 => 80,
            $budgetConsumedPercentage >= 70 => 70,
            default => null,
        };

        return [
            'revenue' => round($revenue, 2),
            'labor_cost' => round($laborCost, 2),
            'overtime_cost' => round($overtimeCost, 2),
            'vendor_cost' => round($vendorCost, 2),
            'direct_expenses' => round($directExpenses, 2),
            'total_cost' => round($totalCost, 2),
            'gross_profit' => round($grossProfit, 2),
            'net_profit' => round($netProfit, 2),
            'margin_percentage' => $marginPercentage,
            'budget_consumed_percentage' => $budgetConsumedPercentage,
            'budget_alert_threshold' => $alertThreshold,
        ];
    }

    /**
     * @return array{
     *     total_revenue: float,
     *     total_cost: float,
     *     total_profit: float,
     *     total_overtime: float,
     *     average_margin: float,
     *     active_projects_count: int
     * }
     */
    public function calculateAgencyOverview(): array
    {
        $projects = Project::whereIn('status', ['active', 'planning', 'completed'])->get();

        $totalRevenue = 0.0;
        $totalCost = 0.0;
        $totalProfit = 0.0;
        $totalOvertime = 0.0;

        foreach ($projects as $project) {
            $metrics = $this->calculateProjectProfitability($project);
            $totalRevenue += $metrics['revenue'];
            $totalCost += $metrics['total_cost'];
            $totalProfit += $metrics['net_profit'];
            $totalOvertime += $metrics['overtime_cost'];
        }

        $averageMargin = $totalRevenue > 0 ? round(($totalProfit / $totalRevenue) * 100, 2) : 0.0;

        return [
            'total_revenue' => round($totalRevenue, 2),
            'total_cost' => round($totalCost, 2),
            'total_profit' => round($totalProfit, 2),
            'total_overtime' => round($totalOvertime, 2),
            'average_margin' => $averageMargin,
            'active_projects_count' => Project::where('status', 'active')->count(),
        ];
    }
}
