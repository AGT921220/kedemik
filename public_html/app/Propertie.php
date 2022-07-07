<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propertie extends Model
{
    use SoftDeletes;
    const SALE_RENT =
    ['sale'=>'Venta',
    'rent'=>'Renta'];
}
