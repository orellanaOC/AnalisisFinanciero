<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class);
    }
}
