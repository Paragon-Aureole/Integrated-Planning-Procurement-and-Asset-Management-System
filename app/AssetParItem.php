<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetParItem extends Model
{
    protected $fillable = [
        'asset_id',
        'asset_par_id',
        // 'asset_turnover_id',
        'quantity',
        'description',
        'property_no',
        'assignedTo',
        'position',
        'itemStatus',
        'date_acquired'
    ];

    public function asset()
    {
        return $this->belongsTo(asset::class);
    }

    public function assetPar()
    {
        return $this->belongsTo(assetPar::class);
    }

    public function assetTurnoverItem()
    {
        return $this->hasMany(AssetTurnoverItem::class);
    }

}
