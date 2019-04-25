<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetPar extends Model
{
    protected $fillable = [
        // 'par_id',
        'name',
        'quantity',
        'unitCost',
        'description',
        'assignedTo',
        'position',
        'asset_id',
        'purchase_order_id'
        // 'amount'
    ];

    public function asset()
    {
        return $this->belongsTo(asset::class);
    }
}
