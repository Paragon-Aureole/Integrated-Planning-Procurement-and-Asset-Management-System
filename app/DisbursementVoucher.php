<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisbursementVoucher extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'disbursementNo',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
