<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyllabusEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'subject_id',
        'topic_id',
        'subtopic_id',
        'main_competence',
        'specific_competence',
        'main_activity',
        'specific_activity',
        'suggested_methods',
        'assessment_criteria',
        'resources',
        'references',
        'number_of_periods',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'number_of_periods' => 'integer',
        'suggested_methods' => 'array',
        'assessment_criteria' => 'array',
        'resources' => 'array',
        'references' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function subtopic(): BelongsTo
    {
        return $this->belongsTo(Subtopic::class);
    }
}
