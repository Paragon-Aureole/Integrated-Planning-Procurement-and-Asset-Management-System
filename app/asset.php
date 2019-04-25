<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
    protected $fillable = [
        'purchase_order_id', 'details', 'amount', 'isICS', 'isPAR', 'item_quantity'
    ];

    // public function getRouteKeyName()
    // {
//     return 'details';
    // }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function asset_par()
    {
        return $this->hasMany(assetPar::class);
    }


}
