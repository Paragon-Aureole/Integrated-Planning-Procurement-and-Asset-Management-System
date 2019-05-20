<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{

    protected $fillable = [
        'purchase_request_id', 
        'user_id',
        'outline_supplier_id',
        'supplier_tin',
        'delivery_place',
        'delivery_date',
        'delivery_term',
        'payment_term'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function outlineSupplier()
    {
        return $this->belongsTo(OutlineSupplier::class);
    }

    public function asset()
    {
        return $this->hasMany(asset::class);
    }

    public function assetPar()
    {
        return $this->hasMany(assetPar::class);
    }

    public function disbursementVoucher()
    {
        return $this->hasOne(PurchaseOrder::class);
    }

    
}
