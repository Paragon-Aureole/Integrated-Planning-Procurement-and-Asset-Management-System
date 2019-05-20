<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'measurement_unit_id',
        'details',
        'amount',
        'item_quantity',
        'item_stock',
        'isICS',
        'isPAR',
        'asset_type_id',
        'isAssigned',
        'isEditable',
        'isRequested'
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

    public function asset_type()
    {
        return $this->belongsTo(assetType::class);
    }

    public function assetIcslipItem()
    {
        return $this->hasMany(assetIcslipItem::class);
    }


}
