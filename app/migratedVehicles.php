<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class migratedVehicles extends Model
{
    protected $fillable = [
        'number',
        'asset_type_id',
        'type_of_vehicle',
        'make',
        'plate_number',
        'acquisition_date',
        'acquisition_cost',
        'office_id',
        'accountable_officer',
        'status'
    ];
}
