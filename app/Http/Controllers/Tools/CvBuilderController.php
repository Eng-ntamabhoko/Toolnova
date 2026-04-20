<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\UserCv;
use Illuminate\Http\Request;

class CvBuilderController extends Controller
{
    public function show()
    {
        $comments = Comment::where('page_type', 'tool')
            ->where('page_slug', 'cv-builder')
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('tools.cv-builder', compact('comments'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'cv_data' => ['required', 'array'],
        ]);

        $cvData = $this->normalizeCvData($request->input('cv_data', []));

        $existingCv = UserCv::where('user_id', auth()->id())
            ->where('title', $request->string('title')->trim()->toString())
            ->first();

        if ($existingCv) {
            $existingCv->update([
                'cv_data' => $cvData,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'CV updated successfully.',
                'cv_id' => $existingCv->id,
            ]);
        }

        $cv = UserCv::create([
            'user_id' => auth()->id(),
            'title' => $request->string('title')->trim()->toString(),
            'cv_data' => $cvData,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'CV saved successfully.',
            'cv_id' => $cv->id,
        ]);
    }

    public function load(UserCv $cv)
    {
        if ($cv->user_id !== auth()->id()) {
            return redirect()->route('dashboard.cvs')->with('error', 'Unauthorized access.');
        }

        $comments = Comment::where('page_type', 'tool')
            ->where('page_slug', 'cv-builder')
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('tools.cv-builder', compact('comments', 'cv'));
    }

    public function delete(UserCv $cv)
    {
        if ($cv->user_id !== auth()->id()) {
            return redirect()->route('dashboard.cvs')->with('error', 'Unauthorized access.');
        }

        $cv->delete();

        return redirect()->route('dashboard.cvs')->with('success', 'CV deleted successfully.');
    }

    public function downloadSavedCv(UserCv $cv, Request $request)
    {
        if ($cv->user_id !== auth()->id()) {
            return redirect()->route('dashboard.cvs')->with('error', 'Unauthorized access.');
        }

        $format = $request->input('format', 'pdf');

        if (!in_array($format, ['pdf', 'word'], true)) {
            return redirect()->route('dashboard.cvs')->with('error', 'Invalid format.');
        }

        $data = $this->normalizeCvData($cv->cv_data ?? []);
        $fileName = $this->makeFileName($data, $format);

        if ($format === 'word') {
            return $this->generateWord($data, $fileName);
        }

        return $this->generatePdf($data, $fileName);
    }

    public function download(Request $request)
    {
        $format = $request->input('format', 'pdf');

        if (!in_array($format, ['pdf', 'word'], true)) {
            return response()->json([
                'message' => 'Invalid format. Use pdf or word.',
            ], 400);
        }

        $data = $this->validatedPayload($request);
        $fileName = $this->makeFileName($data, $format);

        if ($format === 'word') {
            return $this->generateWord($data, $fileName);
        }

        return $this->generatePdf($data, $fileName);
    }

    public function downloadPdf(Request $request)
    {
        $request->merge(['format' => 'pdf']);

        return $this->download($request);
    }

    protected function generatePdf(array $data, string $fileName)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.cv', [
            'data' => $data,
        ])->setPaper('a4', 'portrait');

        return $pdf->download($fileName);
    }

    protected function generateWord(array $data, string $fileName)
    {
        $html = view('word.cv', [
            'data' => $data,
        ])->render();

        return response($html, 200)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    protected function validatedPayload(Request $request): array
    {
        $validated = $request->validate([
            'selectedTemplate' => ['nullable', 'string', 'max:50'],
            'format' => ['nullable', 'string', 'in:pdf,word'],

            'personal' => ['required', 'array'],
            'personal.surname' => ['nullable', 'string', 'max:120'],
            'personal.firstName' => ['nullable', 'string', 'max:120'],
            'personal.otherNames' => ['nullable', 'string', 'max:120'],
            'personal.sex' => ['nullable', 'string', 'max:50'],
            'personal.maritalStatus' => ['nullable', 'string', 'max:50'],
            'personal.birthDate' => ['nullable', 'string', 'max:50'],
            'personal.nationality' => ['nullable', 'string', 'max:120'],

            'contact' => ['required', 'array'],
            'contact.address' => ['nullable', 'string', 'max:255'],
            'contact.mobile1' => ['nullable', 'string', 'max:40'],
            'contact.mobile2' => ['nullable', 'string', 'max:40'],
            'contact.email' => ['nullable', 'email', 'max:120'],

            'education' => ['nullable', 'array'],
            'education.*.year' => ['nullable', 'string', 'max:100'],
            'education.*.institution' => ['nullable', 'string', 'max:255'],
            'education.*.awardCourse' => ['nullable', 'string', 'max:255'],

            'experience' => ['nullable', 'array'],
            'experience.*.period' => ['nullable', 'string', 'max:100'],
            'experience.*.title' => ['nullable', 'string', 'max:255'],
            'experience.*.organization' => ['nullable', 'string', 'max:255'],
            'experience.*.description' => ['nullable', 'string', 'max:2000'],

            'skills' => ['nullable', 'array'],
            'skills.*' => ['nullable', 'string', 'max:255'],

            'additionalSkills' => ['nullable', 'array'],
            'additionalSkills.*' => ['nullable', 'string', 'max:255'],

            'languages' => ['nullable', 'array'],
            'languages.*.language' => ['nullable', 'string', 'max:120'],
            'languages.*.reading' => ['nullable', 'string', 'max:120'],
            'languages.*.writing' => ['nullable', 'string', 'max:120'],
            'languages.*.speaking' => ['nullable', 'string', 'max:120'],

            'interests' => ['nullable', 'array'],
            'interests.*' => ['nullable', 'string', 'max:255'],

            'declaration' => ['nullable', 'string', 'max:2000'],

            'referees' => ['nullable', 'array'],
            'referees.*.name' => ['nullable', 'string', 'max:255'],
            'referees.*.title' => ['nullable', 'string', 'max:255'],
            'referees.*.organization' => ['nullable', 'string', 'max:255'],
            'referees.*.address' => ['nullable', 'string', 'max:255'],
            'referees.*.mobile' => ['nullable', 'string', 'max:40'],

            'signatureDataUrl' => ['nullable', 'string', 'max:20000'],
            'signatureDate' => ['nullable', 'string', 'max:120'],
            'useTodayDate' => ['nullable', 'boolean'],
        ]);

        return $this->normalizeCvData($validated);
    }

    protected function normalizeCvData(array $data): array
    {
        $personal = $data['personal'] ?? [];
        $contact = $data['contact'] ?? [];

        return [
            'selectedTemplate' => $data['selectedTemplate'] ?? 'tz-local',
            'personal' => [
                'surname' => trim((string) ($personal['surname'] ?? '')),
                'firstName' => trim((string) ($personal['firstName'] ?? '')),
                'otherNames' => trim((string) ($personal['otherNames'] ?? '')),
                'sex' => trim((string) ($personal['sex'] ?? '')),
                'maritalStatus' => trim((string) ($personal['maritalStatus'] ?? '')),
                'birthDate' => trim((string) ($personal['birthDate'] ?? '')),
                'nationality' => trim((string) ($personal['nationality'] ?? 'Tanzanian')),
            ],
            'contact' => [
                'address' => trim((string) ($contact['address'] ?? '')),
                'mobile1' => trim((string) ($contact['mobile1'] ?? '')),
                'mobile2' => trim((string) ($contact['mobile2'] ?? '')),
                'email' => trim((string) ($contact['email'] ?? '')),
            ],
            'education' => $this->filterRows($data['education'] ?? [], ['year', 'institution', 'awardCourse']),
            'experience' => $this->filterRows($data['experience'] ?? [], ['period', 'title', 'organization', 'description']),
            'skills' => $this->normalizeList($data['skills'] ?? []),
            'additionalSkills' => $this->normalizeList($data['additionalSkills'] ?? []),
            'languages' => $this->filterRows($data['languages'] ?? [], ['language', 'reading', 'writing', 'speaking']),
            'interests' => $this->normalizeList($data['interests'] ?? []),
            'declaration' => trim((string) ($data['declaration'] ?? '')),
            'referees' => $this->filterRows($data['referees'] ?? [], ['name', 'title', 'organization', 'address', 'mobile']),
            'signatureDataUrl' => (string) ($data['signatureDataUrl'] ?? ''),
            'signatureDate' => trim((string) ($data['signatureDate'] ?? '')),
            'useTodayDate' => (bool) ($data['useTodayDate'] ?? false),
        ];
    }

    protected function normalizeList(array $items): array
    {
        return collect($items)
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }

    protected function filterRows(array $rows, array $keys): array
    {
        return collect($rows)
            ->map(function ($row) use ($keys) {
                $clean = [];

                foreach ($keys as $key) {
                    $clean[$key] = trim((string) ($row[$key] ?? ''));
                }

                return $clean;
            })
            ->filter(function ($row) {
                foreach ($row as $value) {
                    if ($value !== '') {
                        return true;
                    }
                }

                return false;
            })
            ->values()
            ->all();
    }

    protected function makeFileName(array $data, string $format): string
    {
        $fullName = trim(implode(' ', array_filter([
            $data['personal']['surname'] ?? '',
            $data['personal']['firstName'] ?? '',
            $data['personal']['otherNames'] ?? '',
        ])));

        $base = $fullName !== ''
            ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', $fullName))
            : 'cv';

        $base = trim($base, '-');

        return $base . ($format === 'word' ? '.doc' : '.pdf');
    }
}