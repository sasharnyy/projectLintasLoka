<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateYearlySales extends Command
{
    protected $signature = 'sales:calculate-yearly';
    protected $description = 'Calculate total sales for each year and store in sales table';

    public function handle()
    {
        // Ambil total penjualan per tahun
        $sales = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as sale_year'), DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        // Masukkan hasilnya ke tabel sales (tahun)
        foreach ($sales as $sale) {
            DB::table('sales')->updateOrInsert(
                ['sale_date' => $sale->sale_year],  // Menggunakan tahun sebagai sale_date
                ['total_amount' => $sale->total_amount]
            );
        }

        $this->info('Yearly sales calculated successfully!');
    }
}
