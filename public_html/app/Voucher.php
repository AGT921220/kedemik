<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public const KEDEMIK = 'kedemik';
    public const TYPE_REGULAR ='regular';
    public const TYPE_ELECTRONICS = 'electronics';
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
