<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{

    protected $fillable = [
        'purchase_request_id', 
        'user_id',
        'outline_supplier_id',
        'supplier_tin',
        'procurement_mode_id',
        'delivery_place',
        'delivery_date',
        'delivery_term',
        'payment_term'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
}
