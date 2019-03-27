<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
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
        'office_code', 'office_name', 'category',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function ppmp()
    {
        return $this->hasMany(Ppmp::class);
    }

    public function signatory()
    {
        return $this->hasOne(Signatory::class);
    }

    public function purchaseRequest()
    {
        return $this->hasMany(PurchaseRequest::class);
    }

    /** LOCAL SCOPES (samples)
    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');
    }
    */
}
