<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutlineSupplier extends Model
{
    protected $fillable = [
    'outline_id',
    'supplier_name',
    'supplier_address',
    'canvasser_name',
    'canvasser_office',
    'supplier_status',
    'status_reason'
    ];

    public function outlineQuotation()
    {
        return $this->belongsTo(OutlineOfQuotation::class);
    }

    public function outlinePrice()
    {
        return $this->hasMany(OutlineItemPrice::class);
    }

    public function office()
    {
        return $this->belongsTo('App\Office', 'canvasser_office', 'id');
    }
}
