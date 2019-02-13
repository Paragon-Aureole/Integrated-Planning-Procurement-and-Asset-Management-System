<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpmpItem extends Model
{
    protected $fillable = [

    	'ppmp_id',
        'measurement_unit_id',
        'procurement_mode_id',
        'ppmp_item_code_id',
        'item_description',
        'item_quantity',
        'item_budget',
        'item_schedule',
        'item_remaining_quantity',
        'item_remaining_budget',
    ];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }
}
