<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementMode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method_name'
    ];

    public function ppmpItem()
    {
        return $this->hasMany(PpmpItem::class);
    }
    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
