<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

class ReportController extends Controller
{
    public function NonJSOn($year)
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

        return view('reports.monthly', compact('months', 'revenues', 'year'));
    }

    // public function endOfDayReport($date)
    // {
    //     $orders = Order::whereDate('created_at', $date)->with('orderItems')->get();
        
    //     $totalSales = 0;
    //     $productSales = [];

    //     foreach ($orders as $order) {
    //         $totalSales += $order->total_amount;
    //         foreach ($order->orderItems as $item) {
    //             if (!isset($productSales[$item->product_id])) {
    //                 $productSales[$item->product_id] = [
    //                     'name' => $item->product->name,
    //                     'quantity' => 0,
    //                     'total' => 0,
    //                 ];
    //             }
    //             $productSales[$item->product_id]['quantity'] += $item->quantity;
    //             $productSales[$item->product_id]['total'] += $item->price * $item->quantity;
    //         }
    //     }

    //     return view('reports.end_of_day', compact('totalSales', 'productSales', 'date'));
    // }

    public function endOfDayReport($date)
    {
        $orders = Order::whereDate('created_at', $date)->with('orderItems')->get();
        
        $totalSales = 0;
        $productSales = [];

        foreach ($orders as $order) {
            $totalSales += $order->total_amount;
            foreach ($order->orderItems as $item) {
                if (!isset($productSales[$item->product_id])) {
                    $productSales[$item->product_id] = [
                        'name' => $item->product->name,
                        'quantity' => 0,
                        'total' => 0,
                    ];
                }
                $productSales[$item->product_id]['quantity'] += $item->quantity;
                $productSales[$item->product_id]['total'] += $item->price * $item->quantity;
            }
        }

        return view('reports.end_of_day', compact('totalSales', 'productSales', 'date'));
    }

    public function monthlyReport($year)
    {
        $months = [];
        $revenues = [];
        $topProducts = []; 
        $currentYear = date('Y');

        for ($i = 11; $i >= 0; $i--) {
            $month = date('F', strtotime("-$i month"));
            $months[] = $month;

            $totalSales = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', date('n', strtotime("-$i month")))
                ->sum('total_amount');

            $revenues[] = $totalSales;
            $topProducts[$month] = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', date('n', strtotime("-$i month")))
                ->with('orderItems.product') 
                ->get()
                ->flatMap(function ($order) {
                    return $order->orderItems;
                })
                ->groupBy('product_id')
                ->map(function ($group) {
                    return [
                        'name' => $group->first()->product->name,
                        'quantity' => $group->sum('quantity'),
                        'total' => $group->sum(function ($item) {
                            return $item->price * $item->quantity;
                        }),
                    ];
                })
                ->sortByDesc('quantity')
                ->take(10)
                ->values();
        }

        return response()->json([
            'months' => $months,
            'revenues' => $revenues,
            'topProducts' => $topProducts,
            'year' => $year
        ]);
    }

    public function downloadReport(Request $request)
    {
        $date = $request->input('date');
        $totalSales = $request->input('totalSales');
        $productSales = json_decode($request->input('productSales'), true); 

        if (!is_array($productSales)) {
            return back()->withErrors(['productSales' => 'Invalid product sales data.']);
        }

        $pdf = PDF::loadView('reports.end_of_day_pdf', compact('date', 'totalSales', 'productSales'));

        $filename = 'end_of_day_report_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }
}
