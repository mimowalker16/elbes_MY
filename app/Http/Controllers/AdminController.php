<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSales = DB::table('elb_purchases')->count();
        $totalRevenue = DB::table('elb_purchases')->sum('total_amount');
        $ordersThisMonth = DB::table('elb_purchases')
            ->where('order_date', 'like', now()->format('Y-m') . '%')
            ->count();
        $topProducts = DB::table('elb_purchase_items')
            ->join('elb_items', 'elb_purchase_items.product_id', '=', 'elb_items.id')
            ->select('elb_items.name', DB::raw('SUM(elb_purchase_items.quantity) as sold'))
            ->groupBy('elb_items.name')
            ->orderByDesc('sold')
            ->limit(5)
            ->get();
        $userCount = DB::table('elb_accounts')->count();

        // Chart data: last 6 months
        $months = collect(range(0, 5))->map(function($i) {
            return now()->subMonths(5 - $i)->format('Y-m');
        });
        $salesData = [];
        $revenueData = [];
        $ordersData = [];
        foreach ($months as $month) {
            $sales = DB::table('elb_purchase_items')
                ->join('elb_purchases', 'elb_purchase_items.order_id', '=', 'elb_purchases.id')
                ->where('elb_purchases.order_date', 'like', "$month%")
                ->sum('elb_purchase_items.quantity');
            $revenue = DB::table('elb_purchases')
                ->where('order_date', 'like', "$month%")
                ->sum('total_amount');
            $orders = DB::table('elb_purchases')
                ->where('order_date', 'like', "$month%")
                ->count();
            $salesData[] = $sales;
            $revenueData[] = $revenue;
            $ordersData[] = $orders;
        }
        $monthsLabels = $months->map(function($m) {
            return date('M Y', strtotime($m . '-01'));
        });

        return view('admin.dashboard', compact(
            'totalSales', 'totalRevenue', 'ordersThisMonth', 'topProducts', 'userCount',
            'salesData', 'revenueData', 'ordersData', 'monthsLabels'
        ));
    }
}
