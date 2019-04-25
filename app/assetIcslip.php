<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetIcslip extends Model
{
    protected $fillable = [
        'asset_id',
        'quantity',
        'description',
        'assignedTo',
        'inventory_name_no',
        'useful_life'
    ];

    public function assets()
    {
        return $this->belongsTo(asset::class);
    }

    public function asset_turnover()
    {
        return $this->hasOne(assetTurnover::class);
    }

    public function distributedAsset()
    {
        return $this->hasOne(editDistributedAsset::class);
    }
}
