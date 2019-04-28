<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppmp extends Model
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
        'ppmp_year', 'office_id', 'user_id', 'ppmp_budget_id', 'is_active', 'is_supplemental', 'former_ppmp_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ppmpItem()
    {
        return $this->hasMany(PpmpItem::class);
    }

    public function ppmpBudget()
    {
        return $this->hasOne(PpmpBudget::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function ppmpItemCode()
    {
        return $this->hasMany(PpmpItemCode::class);
    }

}
