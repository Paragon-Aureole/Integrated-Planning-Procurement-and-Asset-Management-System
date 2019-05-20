<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetIcslip extends Model
{
    protected $fillable = [
        'purchase_order_id'
        // 'quantity',
        // 'description',
        // 'assignedTo',
        // 'position',
        // 'inventory_name_no',
        // 'useful_life'
    ];

    // public function asset()
    // {
    //     return $this->belongsTo(asset::class);
    // }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function AssetIcslipItem()
    {
        return $this->hasMany(AssetIcslipItem::class);
    }

    public function distributedAsset()
    {
        return $this->hasOne(editDistributedAsset::class);
    }
}
