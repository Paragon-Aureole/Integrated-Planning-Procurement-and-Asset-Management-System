<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequestItem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
