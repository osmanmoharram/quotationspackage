<?php

namespace DOCore\DOQuot\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'doquot_products';

    protected $guarded = [];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'doquot_product_quotation', 'product_id', 'quotation_id')
            ->withPivot(['quantity', 'unit_price', 'subtotal']);
    }
}
