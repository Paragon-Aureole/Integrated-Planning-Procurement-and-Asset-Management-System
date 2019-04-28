<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class migratedAssets extends Model
{
    protected $fillable = [
    'name_of_accountable',
    'official_designation',
    'lgu',
    'article',
    'office_id',
    'description',
    'property_number',
    'unit_of_measure',
    'unit_value',
    'balance_per_card',
    'on_hand_per_count',
    'shortage_overage',
    'date_purchase',
    'status',
    'par_ics_number',
    'remarks',
    'asset_type_id'
    ];
}
