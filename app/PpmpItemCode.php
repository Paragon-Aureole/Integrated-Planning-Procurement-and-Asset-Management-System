<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpmpItemCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ppmp_id', 'code_description', 'code_type',
        //code_type: 1=Office and Department Supplies ,2 = Projects directly under the department, 3= Projects charged on other offices
    ];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }
    public function ppmpItem()
    {
        return $this->hasMany(PpmpItem::class);
    }
}
