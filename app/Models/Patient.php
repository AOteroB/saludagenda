<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // App\Models\Patient.php

    protected $fillable = [
        'name',
        'last_name',
        'dob',
        'dni',
        'sex',
        'address',
        'postal_code',
        'phone',
        'phone_emergence',
        'email',
        'health_card_number',
        'health_insurance',
        'allergies',
        'previous_illnesses',
        'current_medications',
        'medical_notes',
        'blood_type',
    ];

    // Relación inversa con User
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function medical_history()
    {
        return $this->hasMany(MedicalHistory::class);
    }
}
