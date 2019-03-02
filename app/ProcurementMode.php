<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementMode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method_name', 'method_code',
    ];

    public function ppmpItem()
    {
        return $this->hasMany(PpmpItem::class);
    }
}
