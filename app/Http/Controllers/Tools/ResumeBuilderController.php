<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResumeBuilderController extends Controller
{
    public function show()
    {
        return view('tools.resume-builder');
    }

    public function downloadPdf(Request $request)
    {
        \Log::info('PDF downloadPdf called');
        try {
            $validated = $request->validate([
                'personal.fullName' => 'required|string|max:255',
                'personal.jobTitle' => 'nullable|string|max:255',
                'personal.email' => 'nullable|email|max:255',
                'personal.phone' => 'nullable|string|max:50',
                'personal.city' => 'nullable|string|max:100',
                'personal.country' => 'nullable|string|max:100',

                'summary' => 'nullable|string|max:3000',

                'skills' => 'nullable|array',
                'languages' => 'nullable|array',
                'certifications' => 'nullable|array',

                'experience' => 'nullable|array',
                'education' => 'nullable|array',
                'projects' => 'nullable|array',
            ]);

            $data = $validated;

            // Clean data
            $data['personal'] = $data['personal'] ?? [];
            $data['summary'] = is_string($data['summary']) ? trim($data['summary']) : '';
            $data['skills'] = is_array($data['skills']) ? array_filter(array_map('strval', $data['skills'])) : [];
            $data['languages'] = is_array($data['languages']) ? array_filter(array_map('strval', $data['languages'])) : [];
            $data['certifications'] = is_array($data['certifications']) ? array_filter(array_map('strval', $data['certifications'])) : [];
            $data['experience'] = is_array($data['experience']) ? array_filter($data['experience'], fn($e) => is_array($e)) : [];
            $data['education'] = is_array($data['education']) ? array_filter($data['education'], fn($e) => is_array($e)) : [];
            $data['projects'] = is_array($data['projects']) ? array_filter($data['projects'], fn($p) => is_array($p)) : [];

            // Clean experience bullets
            foreach ($data['experience'] as &$exp) {
                if (isset($exp['bullets']) && is_array($exp['bullets'])) {
                    $exp['bullets'] = array_filter(array_map('strval', $exp['bullets']));
                } else {
                    $exp['bullets'] = [];
                }
            }

            $fileName = Str::slug($data['personal']['fullName'] ?? 'resume') . '-resume.pdf';

            if (!class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
                return response()->json([
                    'error' => 'PDF generation library is not available.'
                ], 500);
            }

            $pdf = Pdf::loadView('pdf.resume', [
                'data' => $data,
            ])->setPaper('a4', 'portrait');

            if (method_exists($pdf, 'setOptions')) {
                $pdf->setOptions([
                    'dpi' => 96,
                    'defaultFont' => 'DejaVu Sans',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => false,
                    'isPhpEnabled' => false,
                    'debugCss' => false,
                    'debugLayout' => false,
                    'debugKeepTemp' => false,
                    'debugPng' => false,
                    'debugLayoutLines' => false,
                    'debugLayoutBlocks' => false,
                    'debugLayoutInline' => false,
                    'debugLayoutPaddingBox' => false,
                ]);
            }

            return $pdf->download($fileName);

        } catch (\Throwable $e) {
            \Log::error('PDF ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}