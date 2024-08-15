<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio',
        'precio',
        'acceso',
    ];

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'venta_servicio')->withPivot('cantidad');
    }
}
