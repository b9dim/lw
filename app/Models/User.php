<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'مدير';
    }

    public function isLawyer(): bool
    {
        return $this->role === 'محامي';
    }

    public function isReception(): bool
    {
        return $this->role === 'موظف استقبال';
    }

    public function cases()
    {
        return $this->hasMany(Case_::class, 'lawyer_id');
    }
}

