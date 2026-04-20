<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function syllabusEntries(): HasMany
    {
        return $this->hasMany(SyllabusEntry::class);
    }

    public function lessonPlans(): HasMany
    {
        return $this->hasMany(LessonPlan::class);
    }
}
