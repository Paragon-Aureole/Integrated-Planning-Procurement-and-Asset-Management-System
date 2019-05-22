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

    public function ppmpItemCode()
    {
        return $this->hasMany(PpmpItemCode::class);
    }

    public function signatory()
    {
        return $this->hasOne(Signatory::class);
    }

    public function purchaseRequest()
    {
        return $this->hasMany(PurchaseRequest::class);
    }

    public function outlineSupplier()
    {
        return $this->hasMany(OutlineSupplier::class, 'canvasser_office', 'id');
    }

    public function migratedAssets()
    {
        return $this->hasMany(migratedAssets::class);
    }

    public function migratedIcsAssets()
    {
        return $this->hasMany(migratedIcsAssets::class);
    }

}
