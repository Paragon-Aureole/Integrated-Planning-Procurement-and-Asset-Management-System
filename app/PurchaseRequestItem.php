<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_request_id',
        'ppmp_item_id',
        'item_quantity',
        'item_cost',
        'item_budget'
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function ppmpItem()
    {
        return $this->belongsTo(PpmpItem::class);
    }

    public function outlinePrice()
    {
        return $this->hasOne(OutlineItemPrice::class);
    }
}
