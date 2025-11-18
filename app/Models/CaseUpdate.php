<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'title',
        'detail',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function case()
    {
        return $this->belongsTo(Case_::class, 'case_id', 'id');
    }
}

