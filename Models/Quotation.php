<?php

namespace DOCore\DOQuot\Models;

use DOCore\Organization\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'doquot_quotations';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'doquot_product_quotation', 'quotation_id', 'product_id')
            ->withPivot(['quantity', 'unit_price']);
    }
}
