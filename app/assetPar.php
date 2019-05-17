<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetPar extends Model
{
    protected $fillable = [
        'asset_id',
        'quantity',
        'description',
        'property_no',
        'assignedTo',
        'position'
    ];

    public function asset()
    {
        return $this->belongsTo(asset::class);
    }

    public function distributedAsset()
    {
        return $this->hasOne(editDistributedAsset::class);
    }
    
    public function assetParItem()
    {
        return $this->hasMany(AssetParItem::class);
    }

    public function AssetTurnover()
    {
        return $this->hasMany(AssetTurnover::class);
    }

}
