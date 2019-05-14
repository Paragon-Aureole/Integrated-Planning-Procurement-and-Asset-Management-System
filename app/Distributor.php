<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distributor extends Model
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
        'distributor_name', 'distributor_address', 'category', 'certificate',
    ];

    // public function purchaseRequest()
    // {
    //     return $this->hasMany(PurchaseRequest::class);
    // }
    public function purchaseRequest()
    {
        return $this->belongsTo('\App\PurchaseRequest', 'supplier_id', 'id');
    }
}
