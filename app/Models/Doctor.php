<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    // Definir los campos que pueden ser asignados en masa
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'license_number',
        'status',
        'user_id',
        'specialty_id',
    ];

    // Relación con el modelo User (relación de uno a uno)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relación con la especialidad.
     * Un doctor tiene una especialidad.
     */
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    /**
     * Relación con los horarios.
     * Un doctor tiene muchos horarios.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Relación con las citas.
     * Un doctor tiene muchas citas.
     */
    public function event()
    {
        return $this->hasMany(Event::class);
    }
    
}
