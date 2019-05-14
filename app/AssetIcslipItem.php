<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetIcslipItem extends Model
{
    protected $fillable = [
        'asset_icslip_id',
        'description'
    ];

    public function assetIcsSlip()
    {
        return $this->belongsTo(assetIcslip::class);
    }
}
