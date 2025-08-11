<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransctionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        
        if (empty($row["product_id"]) && empty($row['trx_date']) && empty($row['price'])) {
            return null;
        }
        
        $transaction = new Transaction();
        $transaction->product_id = $row['product_id'];
        $transaction->trx_date = $row['trx_date'];
        $transaction->price = $row['price'];
        $transaction->save();

        return $transaction;
    }
}
