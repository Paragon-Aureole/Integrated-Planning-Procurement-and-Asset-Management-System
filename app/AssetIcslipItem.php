<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetIcslipItem extends Model
{
    protected $fillable = [
        'asset_icslips_id',
        'asset_id',
        'quantity',
        'description',
        'assignedTo',
        'position',
        'inventory_name_no',
        'useful_life'
    ];

    public function assetIcslip()
    {
        return $this->belongsTo(assetIcslip::class);
    }

    public function asset()
    {
        return $this->belongsTo(asset::class);
    }
}
