<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'office_code', 'office_name', 'category',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function ppmp()
    {
        return $this->hasMany(Ppmp::class);
    }

    public function signatory()
    {
        return $this->hasOne(Signatory::class);
    }

    /** LOCAL SCOPES (samples)
    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');    
    }
    */
}
