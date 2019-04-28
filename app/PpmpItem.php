<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpmpItem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $fillable = [

        'ppmp_id',
        'measurement_unit_id',
        'procurement_mode_id',
        'ppmp_item_code_id',
        'item_description',
        'item_quantity',
        'item_budget',
        'item_cost',
        'item_schedule',
        'item_stock',
        'item_rem_budget',
    ];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }

    public function procurementMode()
    {
        return $this->belongsTo(ProcurementMode::class);
    }

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }
    public function ppmpItemCode()
    {
        return $this->belongsTo(PpmpItemCode::class);
    }

    public function prItem()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }
}
