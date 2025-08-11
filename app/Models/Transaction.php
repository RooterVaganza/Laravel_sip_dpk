<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";


    public function formatTrxDate()
    {
        return \Carbon\Carbon::parse($this->trx_date)->format('d/m/y');
    }

    public function priceFormat()
    {
        return 'Rp. ' .number_format($this->price,2,'.',',');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
