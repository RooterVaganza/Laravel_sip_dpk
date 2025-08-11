<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function showImage()
    {
        return asset('storage/' . $this->image);
    }

    public function priceFormat()
    {
        return 'Rp. ' . number_format($this->price, 2, '.', ',');
    }
    public function printStatus()
    {
        if ($this->status == 'Active') {
            return '<span class="badge badge-success">' . $this->status . '</span';
        } else {
            return '<span class="badge badge-danger">' . $this->status . '</span';
        }
    }

    

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
