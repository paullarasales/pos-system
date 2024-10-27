<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    public function monthlyReport($year)
    {
        $months = [];
        $revenues = [];
        $currentYear = date('Y');

        for ($i = 11; $i >= 0; $i--) {
            $month = date('F', strtotime("-$i month"));
            $months[] = $month;

            $totalSales = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', date('n', strtotime("-$i month")))
                ->sum('total_amount');

            $revenues[] = $totalSales;
        }

        return response()->json([
            'months' => $months,
            'revenues' => $revenues,
            'year' => $year
        ]);
    }
    
    public function NonJSOn($year)
    {
        $months = [];
        $revenues = [];
        $currentYear = date('Y');

        for ($i = 11; $i >= 0; $i--) {
            $month = date('F', strtotime("-$i month"));
            $months[] = $month;

            // Fetch orders for the month
            $totalSales = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', date('n', strtotime("-$i month"))) 
                ->sum('total_amount');

            $revenues[] = $totalSales;
        }

        return view('reports.monthly', compact('months', 'revenues', 'year'));
    }

}
