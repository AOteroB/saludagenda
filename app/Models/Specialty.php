<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'location',
        'status',
    ];

    /**
     * La relación con los doctores.
     * Cada especialidad puede tener muchos doctores.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Relación con las citas.
     * Un especialidad tiene muchas citas.
     */
    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
