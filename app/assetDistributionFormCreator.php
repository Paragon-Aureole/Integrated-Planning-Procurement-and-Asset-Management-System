<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetDistributionFormCreator extends Model
{
            protected $fillable = [
        'PAR_id', 'assets_id', 'inputSignatory', 'isProvisioned'
    ];
}
