<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonPlanDraftRequest;
use App\Models\LessonPlan;
use App\Services\LessonPlanDraftService;
use App\Services\SyllabusLookupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
    public function __construct(
        protected SyllabusLookupService $syllabusLookupService,
        protected LessonPlanDraftService $lessonPlanDraftService
    ) {
    }

    public function show()
    {
        return view('tools.lesson-plan', [
            'forms' => $this->syllabusLookupService->getActiveForms(),
            'subjects' => $this->syllabusLookupService->getActiveSubjects(),
        ]);
    }

    public function getTopics(Request $request): JsonResponse
    {
        $request->validate([
            'form_id' => ['required', 'integer', 'exists:forms,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ]);

        $topics = $this->syllabusLookupService->getTopics(
            (int) $request->form_id,
            (int) $request->subject_id
        );

        return response()->json($topics);
    }

    public function getSubtopics(Request $request): JsonResponse
    {
        $request->validate([
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
        ]);

        $subtopics = $this->syllabusLookupService->getSubtopics((int) $request->topic_id);

        return response()->json($subtopics);
    }

    public function getSyllabusEntry(Request $request): JsonResponse
    {
        $request->validate([
            'form_id' => ['required', 'integer', 'exists:forms,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'subtopic_id' => ['nullable', 'integer', 'exists:subtopics,id'],
        ]);

        $entry = $this->syllabusLookupService->findSyllabusEntry(
            (int) $request->form_id,
            (int) $request->subject_id,
            (int) $request->topic_id,
            $request->subtopic_id ? (int) $request->subtopic_id : null
        );

        if (!$entry) {
            return response()->json([
                'message' => 'No syllabus entry found for the selected combination.',
            ], 404);
        }

        return response()->json($entry);
    }

    public function generateDraft(Request $request): JsonResponse
    {
        $request->validate([
            'form_id' => ['required', 'integer', 'exists:forms,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'subtopic_id' => ['nullable', 'integer', 'exists:subtopics,id'],
        ]);

        $entry = $this->syllabusLookupService->findSyllabusEntry(
            (int) $request->form_id,
            (int) $request->subject_id,
            (int) $request->topic_id,
            $request->subtopic_id ? (int) $request->subtopic_id : null
        );

        if (!$entry) {
            return response()->json([
                'message' => 'No syllabus entry found for the selected combination.',
            ], 404);
        }

        $draft = $this->lessonPlanDraftService->generate($entry);

        return response()->json([
            'syllabus_entry_id' => $entry->id,
            'draft' => $draft,
        ]);
    }

    public function saveDraft(StoreLessonPlanDraftRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $registeredGirls = (int) ($validated['registered_girls'] ?? 0);
        $registeredBoys = (int) ($validated['registered_boys'] ?? 0);
        $presentGirls = (int) ($validated['present_girls'] ?? 0);
        $presentBoys = (int) ($validated['present_boys'] ?? 0);

        $lessonPlan = LessonPlan::create([
            'user_id' => auth()->id(),
            'form_id' => $validated['form_id'],
            'subject_id' => $validated['subject_id'],
            'topic_id' => $validated['topic_id'],
            'subtopic_id' => $validated['subtopic_id'] ?? null,
            'syllabus_entry_id' => $validated['syllabus_entry_id'] ?? null,

            'school_name' => $validated['school_name'] ?? null,
            'teacher_name' => $validated['teacher_name'] ?? null,
            'lesson_date' => $validated['lesson_date'] ?? null,
            'lesson_time' => $validated['lesson_time'] ?? null,

            'registered_girls' => $registeredGirls,
            'registered_boys' => $registeredBoys,
            'registered_total' => $registeredGirls + $registeredBoys,

            'present_girls' => $presentGirls,
            'present_boys' => $presentBoys,
            'present_total' => $presentGirls + $presentBoys,

            'main_competence' => $validated['main_competence'] ?? null,
            'specific_competence' => $validated['specific_competence'] ?? null,
            'main_activity' => $validated['main_activity'] ?? null,
            'specific_activity' => $validated['specific_activity'] ?? null,
            'teaching_learning_resources' => $validated['teaching_learning_resources'] ?? null,
            'references_text' => $validated['references_text'] ?? null,

            'introduction' => $validated['introduction'] ?? null,
            'competence_development' => $validated['competence_development'] ?? null,
            'design_stage' => $validated['design_stage'] ?? null,
            'realisation' => $validated['realisation'] ?? null,

            'remarks' => $validated['remarks'] ?? null,
            'status' => 'draft',
        ]);

        return response()->json([
            'message' => 'Lesson plan draft saved successfully.',
            'lesson_plan_id' => $lessonPlan->id,
        ]);
    }
}