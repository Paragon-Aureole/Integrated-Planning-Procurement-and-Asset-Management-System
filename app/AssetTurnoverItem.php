<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetTurnoverItem extends Model
{

    protected $fillable = [
        'asset_turnover_id',
        'asset_par_item_id'
    ];

    public function assetTurnover()
    {
        return $this->belongsTo(assetTurnover::class);
    }

    public function AssetParItem()
    {
        return $this->belongsTo(AssetParItem::class);
    }
}
