<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetParItem extends Model
{
    public function assetPar()
    {
        return $this->belongsTo(assetPar::class);
    }
}
