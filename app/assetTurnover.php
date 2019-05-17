<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetTurnover extends Model
{
    protected $fillable = [
        'asset_par_item_id',
        'isApproved',
        'turnoverData'
    ];

    public function assetParItem()
    {
        return $this->belongsTo(assetParItem::class);
    }

}
