<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Subtopic;
use App\Models\SyllabusEntry;
use Illuminate\Support\Collection;

class SyllabusLookupService
{
    public function getActiveForms(): Collection
    {
        return Form::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function getActiveSubjects(): Collection
    {
        return Subject::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getTopics(int $formId, int $subjectId): Collection
    {
        return Topic::where('is_active', true)
            ->where('form_id', $formId)
            ->where('subject_id', $subjectId)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }

    public function getSubtopics(int $topicId): Collection
    {
        return Subtopic::where('is_active', true)
            ->where('topic_id', $topicId)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }

    public function findSyllabusEntry(
        int $formId,
        int $subjectId,
        int $topicId,
        ?int $subtopicId = null
    ): ?SyllabusEntry {
        $query = SyllabusEntry::where('is_active', true)
            ->where('form_id', $formId)
            ->where('subject_id', $subjectId)
            ->where('topic_id', $topicId);

        if ($subtopicId) {
            $query->where('subtopic_id', $subtopicId);
            $entry = $query->first();

            if ($entry) {
                return $entry;
            }
        }

        return SyllabusEntry::where('is_active', true)
            ->where('form_id', $formId)
            ->where('subject_id', $subjectId)
            ->where('topic_id', $topicId)
            ->whereNull('subtopic_id')
            ->first();
    }
}