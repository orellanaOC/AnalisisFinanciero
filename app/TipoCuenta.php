<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    protected $table = 'tipo_cuenta';

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class);
    }
}
