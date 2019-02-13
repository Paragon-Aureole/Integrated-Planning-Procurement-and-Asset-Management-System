<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpmpBudget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ppmp_id', 'ppmp_est_budget', 'ppmp_rem_budget'
    ];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }

}
