<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutlineItemPrice extends Model
{
    protected $fillable = [
        'outline_supplier_id',
        'pr_item_id',
        'final_cpu',
        'final_cpi'
    ];

    public function outlineSupplier()
    {
        return $this->belongsTo(OutlineSupplier::class);
    }

    public function prItem()
    {
        return $this->belongsTo(PurchaseRequestItem::class);
    }
}
