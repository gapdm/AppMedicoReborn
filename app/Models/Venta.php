<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'total',
        'medico_id'
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'venta_servicio')->withPivot('cantidad');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }
}