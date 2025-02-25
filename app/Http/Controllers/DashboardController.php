<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Deteksi apakah database yang digunakan adalah SQLite
        $isSqlite = DB::connection()->getDriverName() === 'sqlite';

        // Query untuk Revenue Per Bulan
        $monthlyRevenue = Sales::selectRaw(
            $isSqlite
                ? 'strftime("%m", created_at) as month, strftime("%Y", created_at) as year, SUM(order_fee) as total_fee'
                : 'MONTH(created_at) as month, YEAR(created_at) as year, SUM(order_fee) as total_fee'
        )
            ->groupBy('year', 'month')
            ->orderByRaw('year DESC, month DESC')
            ->get();

        // Query untuk Revenue Per Tahun
        $yearlyRevenue = Sales::selectRaw(
            $isSqlite
                ? 'strftime("%Y", created_at) as year, SUM(order_fee) as total_fee'
                : 'YEAR(created_at) as year, SUM(order_fee) as total_fee'
        )
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->get();

        // Query untuk Jumlah Transaksi Per Bulan
        $monthlySales = Sales::selectRaw(
            $isSqlite
                ? 'strftime("%m", created_at) as month, strftime("%Y", created_at) as year, COUNT(id) as total_sales'
                : 'MONTH(created_at) as month, YEAR(created_at) as year, COUNT(id) as total_sales'
        )
            ->groupBy('year', 'month')
            ->orderByRaw('year DESC, month DESC')
            ->get();

        // Query untuk Jumlah Transaksi Per Tahun
        $yearlySales = Sales::selectRaw(
            $isSqlite
                ? 'strftime("%Y", created_at) as year, COUNT(id) as total_sales'
                : 'YEAR(created_at) as year, COUNT(id) as total_sales'
        )
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->get();

        return view('dashboards.index', compact('monthlyRevenue', 'yearlyRevenue', 'monthlySales', 'yearlySales'));
    }
}
