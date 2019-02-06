<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distributor_name', 'distributor_address', 'category', 'certificate',
    ];
}
