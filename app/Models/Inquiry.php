<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'client_id',
        'message',
        'reply',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function case()
    {
        return $this->belongsTo(Case_::class, 'case_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function isReplied(): bool
    {
        return !is_null($this->reply);
    }
}

