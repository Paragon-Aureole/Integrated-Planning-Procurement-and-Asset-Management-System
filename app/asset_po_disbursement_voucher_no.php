<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset_po_disbursement_voucher_no extends Model
{
    protected $fillable = [
        'purchase_order_id', 'disbursementNo'
    ];

}
