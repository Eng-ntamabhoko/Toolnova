@extends('layouts.tool')

@section('title', 'O-Level Lesson Plan Generator (TIE Format)')
@section('meta_description', 'Generate Tanzania O-Level lesson plans in TIE format with editable preview and syllabus-based content.')

@section('tool_title', 'O-Level Lesson Plan Generator (TIE Format)')
@section('tool_description', 'Generate Tanzania O-Level lesson plans in TIE format with syllabus-based content.')

@section('tool_content')
<div
    x-data="lessonPlanTool()"
    x-init="init()"
    data-tool-slug="lesson-plan-generator"
    class="bg-slate-50 min-h-screen"
    x-cloak
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 lg:gap-8 items-start">
            <div class="xl:col-span-7 2xl:col-span-8 space-y-6">
                @include('tools.partials.lesson-plan-form')
            </div>

            <div class="xl:col-span-5 2xl:col-span-4">
                <div class="hidden xl:block">
                    @include('tools.partials.lesson-plan-preview')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function lessonPlanTool() {
    return {
        topics: [],
        subtopics: [],
        syllabus_entry_id: null,

        activeSection: 'basic',

        sections: [
            { key: 'basic', label: 'Basic Information' },
            { key: 'topic', label: 'Topic & Syllabus' },
            { key: 'students', label: 'Students Information' },
            { key: 'competence', label: 'Competence Information' },
            { key: 'iddr', label: 'IDDR Stages' },
            { key: 'review', label: 'Final Review' },
        ],

        iddrSections: [
            { key: 'introduction', label: 'Introduction' },
            { key: 'competence_development', label: 'Competence Development' },
            { key: 'design_stage', label: 'Design' },
            { key: 'realisation', label: 'Realisation' },
        ],

        activeIddrSection: 'introduction',

        form: {
            school_name: '',
            teacher_name: '',
            form_id: '',
            subject_id: '',
            topic_id: '',
            subtopic_id: '',
            lesson_date: '',
            lesson_time: '',
            registered_girls: 0,
            registered_boys: 0,
            present_girls: 0,
            present_boys: 0,
            remarks: ''
        },

        draft: {
            main_competence: '',
            specific_competence: '',
            main_activity: '',
            specific_activity: '',
            teaching_learning_resources: '',
            references_text: '',
            introduction: { time: 5, teaching: '', learning: '', assessment: '' },
            competence_development: { time: 15, teaching: '', learning: '', assessment: '' },
            design_stage: { time: 10, teaching: '', learning: '', assessment: '' },
            realisation: { time: 10, teaching: '', learning: '', assessment: '' }
        },

        async init() {
            if (typeof window.trackToolUsage === 'function') {
                await window.trackToolUsage('lesson-plan-generator', 'page_view');
            }
        },

        openSection(key) {
            this.activeSection = this.activeSection === key ? '' : key;
        },

        openIddr(key) {
            this.activeIddrSection = this.activeIddrSection === key ? '' : key;
        },

        isSectionComplete(key) {
            if (key === 'basic') {
                return !!(
                    this.form.school_name ||
                    this.form.teacher_name ||
                    this.form.form_id ||
                    this.form.subject_id ||
                    this.form.lesson_date ||
                    this.form.lesson_time
                );
            }

            if (key === 'topic') {
                return !!(this.form.topic_id || this.form.subtopic_id || this.syllabus_entry_id);
            }

            if (key === 'students') {
                return (
                    Number(this.form.registered_girls) > 0 ||
                    Number(this.form.registered_boys) > 0 ||
                    Number(this.form.present_girls) > 0 ||
                    Number(this.form.present_boys) > 0
                );
            }

            if (key === 'competence') {
                return !!(
                    this.draft.main_competence ||
                    this.draft.specific_competence ||
                    this.draft.main_activity ||
                    this.draft.specific_activity
                );
            }

            if (key === 'iddr') {
                return !!(
                    this.draft.introduction.teaching ||
                    this.draft.competence_development.teaching ||
                    this.draft.design_stage.teaching ||
                    this.draft.realisation.teaching
                );
            }

            if (key === 'review') {
                return !!(this.form.remarks);
            }

            return false;
        },

        get registeredTotal() {
            return (Number(this.form.registered_girls) || 0) + (Number(this.form.registered_boys) || 0);
        },

        get presentTotal() {
            return (Number(this.form.present_girls) || 0) + (Number(this.form.present_boys) || 0);
        },

        get selectedFormName() {
            const select = document.querySelector('select[x-model="form.form_id"]');
            if (!select) return '';
            const option = select.options[select.selectedIndex];
            return option ? option.text : '';
        },

        get selectedSubjectName() {
            const select = document.querySelector('select[x-model="form.subject_id"]');
            if (!select) return '';
            const option = select.options[select.selectedIndex];
            return option ? option.text : '';
        },

        async loadTopics() {
            this.topics = [];
            this.subtopics = [];
            this.form.topic_id = '';
            this.form.subtopic_id = '';
            this.syllabus_entry_id = null;

            if (!this.form.form_id || !this.form.subject_id) return;

            const response = await fetch(`{{ route('tools.lesson-plan.topics') }}?form_id=${this.form.form_id}&subject_id=${this.form.subject_id}`);
            this.topics = await response.json();
        },

        async loadSubtopics() {
            this.subtopics = [];
            this.form.subtopic_id = '';
            this.syllabus_entry_id = null;

            if (!this.form.topic_id) return;

            const response = await fetch(`{{ route('tools.lesson-plan.subtopics') }}?topic_id=${this.form.topic_id}`);
            this.subtopics = await response.json();
        },

        async generateDraft() {
            if (!this.form.form_id || !this.form.subject_id || !this.form.topic_id) {
                alert('Please select form, subject, and topic first.');
                return;
            }

            const response = await fetch(`{{ route('tools.lesson-plan.generate-draft') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    form_id: this.form.form_id,
                    subject_id: this.form.subject_id,
                    topic_id: this.form.topic_id,
                    subtopic_id: this.form.subtopic_id || null
                })
            });

            const data = await response.json();

            if (response.ok && typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('lesson-plan-generator', 'generate_draft', {
                    form_id: this.form.form_id,
                    subject_id: this.form.subject_id,
                    topic_id: this.form.topic_id,
                    subtopic_id: this.form.subtopic_id || null,
                });
            }

            if (!response.ok) {
                alert(data.message || 'Failed to generate draft.');
                return;
            }

            this.syllabus_entry_id = data.syllabus_entry_id;
            this.draft = data.draft;
            this.activeSection = 'competence';
        },

        async saveDraft() {
            if (!this.form.form_id || !this.form.subject_id || !this.form.topic_id) {
                alert('Please complete the required fields first.');
                return;
            }

            const payload = {
                form_id: this.form.form_id,
                subject_id: this.form.subject_id,
                topic_id: this.form.topic_id,
                subtopic_id: this.form.subtopic_id || null,
                syllabus_entry_id: this.syllabus_entry_id,

                school_name: this.form.school_name,
                teacher_name: this.form.teacher_name,
                lesson_date: this.form.lesson_date,
                lesson_time: this.form.lesson_time,

                registered_girls: this.form.registered_girls,
                registered_boys: this.form.registered_boys,
                present_girls: this.form.present_girls,
                present_boys: this.form.present_boys,

                main_competence: this.draft.main_competence,
                specific_competence: this.draft.specific_competence,
                main_activity: this.draft.main_activity,
                specific_activity: this.draft.specific_activity,
                teaching_learning_resources: this.draft.teaching_learning_resources,
                references_text: this.draft.references_text,

                introduction: this.draft.introduction,
                competence_development: this.draft.competence_development,
                design_stage: this.draft.design_stage,
                realisation: this.draft.realisation,

                remarks: this.form.remarks
            };

            const response = await fetch(`{{ route('tools.lesson-plan.save-draft') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (!response.ok) {
                alert(data.message || 'Failed to save draft.');
                return;
            }

            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('lesson-plan-generator', 'save_draft', {
                    form_id: this.form.form_id,
                    subject_id: this.form.subject_id,
                    topic_id: this.form.topic_id,
                    subtopic_id: this.form.subtopic_id || null,
                    lesson_plan_id: data.lesson_plan_id || null,
                });
            }

            alert(data.message || 'Draft saved successfully.');
        },

        resetForm() {
            this.topics = [];
            this.subtopics = [];
            this.syllabus_entry_id = null;
            this.activeSection = 'basic';
            this.activeIddrSection = 'introduction';

            this.form = {
                school_name: '',
                teacher_name: '',
                form_id: '',
                subject_id: '',
                topic_id: '',
                subtopic_id: '',
                lesson_date: '',
                lesson_time: '',
                registered_girls: 0,
                registered_boys: 0,
                present_girls: 0,
                present_boys: 0,
                remarks: ''
            };

            this.draft = {
                main_competence: '',
                specific_competence: '',
                main_activity: '',
                specific_activity: '',
                teaching_learning_resources: '',
                references_text: '',
                introduction: { time: 5, teaching: '', learning: '', assessment: '' },
                competence_development: { time: 15, teaching: '', learning: '', assessment: '' },
                design_stage: { time: 10, teaching: '', learning: '', assessment: '' },
                realisation: { time: 10, teaching: '', learning: '', assessment: '' }
            };
        }
    }
}
</script>
@endsection

@section('tool_about')
<p>
    Generate Tanzania O-Level lesson plans in TIE format with syllabus-based draft content, editable fields, and saveable lesson plan drafts.
</p>
@endsection

@section('tool_guide')
<p class="mb-4">
    Fill the lesson plan section by section. Start with basic information, load official syllabus content, refine the competence and IDDR stages, then review and save the draft.
</p>
<p>
    Use the preview panel to confirm the lesson plan structure before saving.
</p>
@endsection