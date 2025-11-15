<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_ extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'client_id',
        'lawyer_id',
        'court_name',
        'status',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }

    public function updates()
    {
        return $this->hasMany(CaseUpdate::class, 'case_id', 'id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'case_id', 'id');
    }
}

