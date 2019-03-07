<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequest extends Model
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
        'ppmp_id',
		'signatory_id',
		'user_id',
        'office_id',
        'pr_code',
		'pr_purpose',
		'pr_budget',
		'supplier_type',
        'agency_name',
		'supplier_id',
		'pr_status',
		'created_supplemental',
		'created_rfq',
		'created_abstract',
		'created_po',
		'created_inspection',
    ];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function signatory()
    {
        return $this->belongsTo(Signatory::class);
    }
    public function distributor()
    {
        return $this->hasOne(Distributor::class);
    }

    public function prItem()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }
}
