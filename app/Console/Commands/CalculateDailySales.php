<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateDailySales extends Command
{
    protected $signature = 'sales:calculate-daily';
    protected $description = 'Calculate total sales for each day and store in sales table';

    public function handle()
    {
        // Ambil total penjualan per tanggal
        $sales = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as sale_date'), DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        // Masukkan hasilnya ke tabel sales
        foreach ($sales as $sale) {
            DB::table('sales')->updateOrInsert(
                ['sale_date' => $sale->sale_date],
                ['total_amount' => $sale->total_amount]
            );
        }

        $this->info('Daily sales calculated successfully!');
    }
}
