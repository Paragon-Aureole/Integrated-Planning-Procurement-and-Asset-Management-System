<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutlineOfQuotation extends Model
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
        'user_id',
        'purchase_request_id',
        'outline_detail',
        'outline_comment'
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
        return $this->hasMany(OutlineSupplier::class);
    }
}
