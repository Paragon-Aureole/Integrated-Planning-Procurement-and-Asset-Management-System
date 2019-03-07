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
		'measurement_unit_id',
		'item_description',
		'item_quantity',
		'item_cpu',
		'item_cpi'
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }


}
