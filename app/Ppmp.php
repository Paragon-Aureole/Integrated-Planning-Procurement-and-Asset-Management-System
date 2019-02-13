<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppmp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ppmp_year', 'office_id', 'user_id', 'ppmp_budget_id', 'is_active'
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

    public function ppmpItemCode()
    {
        return $this->hasMany(PpmpItemCode::class);
    }



}
