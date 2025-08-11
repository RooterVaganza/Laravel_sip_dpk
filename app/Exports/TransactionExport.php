<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements
    FromQuery,
    WithMapping,
    WithHeadings,
    ShouldQueue
{
    use Exportable;

    public function headings(): array
    {
        return ['Product Name', 'Transaction Date', 'Price'];
    }

    public function query()
    {
        return Transaction::query()
            ->join('products', 'products.id', '=', 'transactions.product_id')
            ->select([
                'products.name as product_name',
                'transactions.trx_date',
                'transactions.price'
            ])
            ->orderBy( 'transactions.id');
    }
    public function map($trx): array
    {
        $date = $trx->trx_date;
        if ($date instanceof \Carbon\Carbon) {
            $formattedDate = $date->toDateString();
        } else {
            $formattedDate = $date ? \Carbon\Carbon::parse($date)->toDateString() : '-';
        }
        return [
            $trx->product_name ?? '-',
            $formattedDate,
            $trx->price
        ];
    }


    public function chunkSize(): int
    {
        return 5000;
    }

    public function customChunkSize(): int
    {
        return 5000;
    }
}
