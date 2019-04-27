<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetType extends Model
{
    protected $fillable = [
        'type_name'
    ];

    public function assets()
    {
        return $this->hasOne(asset::class);
    }

}
