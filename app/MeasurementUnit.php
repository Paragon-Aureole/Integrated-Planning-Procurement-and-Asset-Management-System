<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unit_code', 'unit_description',
    ];

    public function ppmpItem()
    {
        return $this->hasMany(PpmpItem::class);
    }
}
