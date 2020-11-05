<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuenta';
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function tipo()
    {
        return $this->belongsTo(TipoCuenta::class);
    }
}
