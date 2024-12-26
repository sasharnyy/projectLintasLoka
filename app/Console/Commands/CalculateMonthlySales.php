<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateMonthlySales extends Command
{
    protected $signature = 'sales:calculate-monthly';
    protected $description = 'Calculate total sales for each month and store in sales table';

    public function handle()
    {
        // Ambil total penjualan per bulan
        $sales = DB::table('orders')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as sale_month'), DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->get();

        // Masukkan hasilnya ke tabel sales (bulan)
        foreach ($sales as $sale) {
            DB::table('sales')->updateOrInsert(
                ['sale_date' => $sale->sale_month],  // Menggunakan bulan sebagai sale_date
                ['total_amount' => $sale->total_amount]
            );
        }

        $this->info('Monthly sales calculated successfully!');
    }
}
