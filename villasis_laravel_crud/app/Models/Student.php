<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public const MAX_STUDENTS = 50;

    public const STATUSES = [
        'regular',
        'irregular',
    ];

    protected $fillable = [
        'lastname',
        'firstname',
        'province',
        'country',
        'school',
        'program',
        'program_major',
        'year',
        'status',
        'birthday',
        'subjects',
        'photo_path',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'year' => 'integer',
            'subjects' => 'array',
        ];
    }
}
