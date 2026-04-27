<?php

namespace App\Services;

use App\Models\SyllabusEntry;

class LessonPlanDraftService
{
    public function generate(SyllabusEntry $entry): array
    {
        $methods = $entry->suggested_methods ?? [];
        $assessment = $entry->assessment_criteria ?? [];
        $resources = $entry->resources ?? [];
        $references = $entry->references ?? [];

        return [
            'main_competence' => $entry->main_competence,
            'specific_competence' => $entry->specific_competence,
            'main_activity' => $entry->main_activity,
            'specific_activity' => $entry->specific_activity,
            'teaching_learning_resources' => $this->joinLines($resources),
            'references_text' => $this->joinLines($references),

            'introduction' => [
                'time' => 5,
                'teaching' => $this->buildIntroductionTeaching($entry, $methods),
                'learning' => $this->buildIntroductionLearning($entry),
                'assessment' => $this->pickAssessment($assessment, 'intro'),
            ],

            'competence_development' => [
                'time' => 15,
                'teaching' => $this->buildDevelopmentTeaching($entry, $methods),
                'learning' => $this->buildDevelopmentLearning($entry),
                'assessment' => $this->pickAssessment($assessment, 'development'),
            ],

            'design_stage' => [
                'time' => 10,
                'teaching' => $this->buildDesignTeaching($entry, $methods),
                'learning' => $this->buildDesignLearning($entry),
                'assessment' => $this->pickAssessment($assessment, 'design'),
            ],

            'realisation' => [
                'time' => 10,
                'teaching' => $this->buildRealisationTeaching($entry),
                'learning' => $this->buildRealisationLearning($entry),
                'assessment' => $this->pickAssessment($assessment, 'realisation'),
            ],
        ];
    }

    private function buildIntroductionTeaching(SyllabusEntry $entry, array $methods): string
    {
        $methodText = $this->pickMethodText($methods, ['brainstorm', 'question', 'answer', 'observation']);
        return $methodText
            ? "Guide learners through {$methodText} to activate prior knowledge related to {$entry->specific_competence}."
            : "Introduce the lesson by activating learners' prior knowledge and linking it to the new competence.";
    }

    private function buildIntroductionLearning(SyllabusEntry $entry): string
    {
        return "Respond to starter questions, share prior knowledge, and participate in introductory activities related to the lesson.";
    }

    private function buildDevelopmentTeaching(SyllabusEntry $entry, array $methods): string
    {
        $methodText = $this->pickMethodText($methods, ['discussion', 'demonstration', 'explanation', 'observation', 'group']);
        return $methodText
            ? "Facilitate {$methodText} to help learners develop the intended competence through the selected activity."
            : "Guide learners through the main teaching and learning activities to build the intended competence.";
    }

    private function buildDevelopmentLearning(SyllabusEntry $entry): string
    {
        return "Participate actively in guided learning activities, discuss ideas, observe, respond, and develop understanding of the concept.";
    }

    private function buildDesignTeaching(SyllabusEntry $entry, array $methods): string
    {
        $methodText = $this->pickMethodText($methods, ['project', 'case', 'application', 'exercise', 'group']);
        return $methodText
            ? "Guide learners to apply their knowledge through {$methodText} in a meaningful task."
            : "Provide an application task that helps learners use the knowledge and skills in another context.";
    }

    private function buildDesignLearning(SyllabusEntry $entry): string
    {
        return "Apply the learned competence in an activity, task, or exercise and share the outcome with peers or the teacher.";
    }

    private function buildRealisationTeaching(SyllabusEntry $entry): string
    {
        return "Assess learners' achievement, give feedback, and conclude the lesson based on the expected outcomes.";
    }

    private function buildRealisationLearning(SyllabusEntry $entry): string
    {
        return "Complete the assessment task, demonstrate the learned competence, and reflect on what has been learned.";
    }

    private function pickAssessment(array $assessment, string $stage): string
    {
        if (!empty($assessment)) {
            return implode("\n", $assessment);
        }

        return match ($stage) {
            'intro' => 'Learners show readiness and connect prior knowledge to the lesson.',
            'development' => 'Learners demonstrate understanding of the intended competence during the activity.',
            'design' => 'Learners apply the developed competence correctly in the task.',
            'realisation' => 'Learners demonstrate the expected performance based on the lesson objective.',
            default => 'Assessment will be based on learner performance.',
        };
    }

    private function pickMethodText(array $methods, array $keywords): ?string
    {
        foreach ($methods as $method) {
            $lower = strtolower($method);
            foreach ($keywords as $keyword) {
                if (str_contains($lower, $keyword)) {
                    return $method;
                }
            }
        }

        return $methods[0] ?? null;
    }

    private function joinLines(array $items): string
    {
        return implode("\n", $items);
    }
}