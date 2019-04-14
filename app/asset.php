<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
    protected $fillable = [
        'purchase_order_id', 'details', 'amount', 'isSup', 'isICS', 'isPAR', 'item_quantity'
    ];

// public function getRouteKeyName()
// {
//     return 'details';
// }

 public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

}
