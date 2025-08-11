<?php

namespace App\Http\Controllers;

use App\Http\Export\TransactionExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransctionImport;

class TransactionController extends Controller
{
    public function create()
    {
        return view('admin.transactions.create');
    }

    public function index()
    {
        // Mengambil semua data transaksi dari database
        $transactions = Transaction::with('product')->orderBy('trx_date','desc')->paginate(5);

        // Mengirimkan data transaksi ke view 'admin.transactions.index'
        return view('admin.transactions.index', compact('transactions'));
    }

    public function import(Request $request) {
        $rules = [
            'excel'=> 'required|mimes:xls,xlsx'
        ];
        
        $messages = [
            'excel.required'=> 'File tidak boleh kosong',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('transactions.create')->withErrors($validator)->withInput($request->all());
        }

        Excel::import(new TransctionImport, $request->file('excel'));
        return redirect()->route('transactions.index')->with('message', 'create transaction succsess');
    }
    
    // Tambahan: Metode baru untuk fungsionalitas export
    public function export()
    {
        return Excel::download(new \App\Exports\TransactionExport, 'transactions_'.date('d_m_y').'_'.time().'.xls');
    }
}
