<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_id',
        'subject_id',
        'topic_id',
        'subtopic_id',
        'syllabus_entry_id',
        'school_name',
        'teacher_name',
        'lesson_date',
        'lesson_time',
        'registered_girls',
        'registered_boys',
        'registered_total',
        'present_girls',
        'present_boys',
        'present_total',
        'main_competence',
        'specific_competence',
        'main_activity',
        'specific_activity',
        'teaching_learning_resources',
        'references_text',
        'introduction',
        'competence_development',
        'design_stage',
        'realisation',
        'remarks',
        'status',
        'pdf_path',
        'word_path',
    ];

    protected $casts = [
        'lesson_date' => 'date',
        'registered_girls' => 'integer',
        'registered_boys' => 'integer',
        'registered_total' => 'integer',
        'present_girls' => 'integer',
        'present_boys' => 'integer',
        'present_total' => 'integer',
        'introduction' => 'array',
        'competence_development' => 'array',
        'design_stage' => 'array',
        'realisation' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    public function syllabusEntry(): BelongsTo
    {
        return $this->belongsTo(SyllabusEntry::class);
    }
}
