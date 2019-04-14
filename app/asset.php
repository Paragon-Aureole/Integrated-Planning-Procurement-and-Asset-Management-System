<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
        protected $fillable = [
        'PO_id', 'details', 'amount', 'isSup', 'isICS', 'isPAR'
    ];

// public function getRouteKeyName()
// {
//     return 'details';
// }

}
