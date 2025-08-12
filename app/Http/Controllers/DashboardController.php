<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {

        $transactions = Transaction::select(DB::raw("MONTHNAME(trx_date) AS month"), DB::raw("COUNT(*) AS total"))
            ->groupBy(DB::raw("MONTHNAME(trx_date)"))
            ->orderByRaw("MONTH(trx_date)")
            ->get();

        $months = [];
        $totals = [];

        foreach ($transactions as $key => $transaction) {
            $months[] = $transaction->month;
            $totals[] = $transaction->total;
        }

        $chart = [
            'months' => $months,
            'totals' => $totals
        ];

        $latestTransactions = Transaction::with('product' )
            ->latest()
            ->limit(15)
            ->get();
            


        return view('admin.dashborad', compact('chart', 'latestTransactions'));
    }
}
