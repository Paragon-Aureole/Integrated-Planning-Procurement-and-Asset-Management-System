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
        'position',
        'inventory_name_no',
        'useful_life'
    ];

    public function asset()
    {
        return $this->belongsTo(asset::class);
    }

    public function distributedAsset()
    {
        return $this->hasOne(editDistributedAsset::class);
    }

}
