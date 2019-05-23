<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetPar extends Model
{
    protected $fillable = [
      'purchase_order_id',
      'assignedTo',
      'position'
    ];

    public function distributedAsset()
    {
        return $this->hasOne(editDistributedAsset::class);
    }
    
    public function assetParItem()
    {
        return $this->hasMany(AssetParItem::class);
    }

    // public function AssetTurnover()
    // {
    //     return $this->hasMany(AssetTurnover::class);
    // }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

}
