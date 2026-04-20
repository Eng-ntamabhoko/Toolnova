<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $categories = [
            ['name' => 'Calculators', 'slug' => 'calculators', 'description' => 'Numeric calculators and finance utilities.'],
            ['name' => 'Text Tools', 'slug' => 'text-tools', 'description' => 'Tools for manipulating and analyzing text.'],
            ['name' => 'Developer Tools', 'slug' => 'developer-tools', 'description' => 'Utilities for developers and data formatting.'],
            ['name' => 'Image Tools', 'slug' => 'image-tools', 'description' => 'Image processing and optimization tools.'],
            ['name' => 'Documents', 'slug' => 'documents', 'description' => 'Document generation and formatting tools.'],
            ['name' => 'Utilities', 'slug' => 'utilities', 'description' => 'Miscellaneous helpful tools.'],
        ];

        foreach ($categories as $category) {
            DB::table('tool_categories')->updateOrInsert(
                ['slug' => $category['slug']],
                array_merge($category, ['created_at' => $now, 'updated_at' => $now])
            );
        }

        $categoryMap = collect(DB::table('tool_categories')->get())->keyBy('slug');

        $tools = [
            ['name' => 'Age Calculator', 'slug' => 'age-calculator', 'category' => 'calculators'],
            ['name' => 'Word Counter', 'slug' => 'word-counter', 'category' => 'text-tools'],
            ['name' => 'Password Generator', 'slug' => 'password-generator', 'category' => 'utilities'],
            ['name' => 'JSON Formatter', 'slug' => 'json-formatter', 'category' => 'developer-tools'],
            ['name' => 'QR Code Generator', 'slug' => 'qr-code-generator', 'category' => 'utilities'],
            ['name' => 'Image Compressor', 'slug' => 'image-compressor', 'category' => 'image-tools'],
            ['name' => 'Image Resizer', 'slug' => 'image-resizer', 'category' => 'image-tools'],
            ['name' => 'Percentage Calculator', 'slug' => 'percentage-calculator', 'category' => 'calculators'],
            ['name' => 'Discount Calculator', 'slug' => 'discount-calculator', 'category' => 'calculators'],
            ['name' => 'Loan Calculator', 'slug' => 'loan-calculator', 'category' => 'calculators'],
            ['name' => 'Base64 Encoder / Decoder', 'slug' => 'base64-encoder-decoder', 'category' => 'developer-tools'],
            ['name' => 'Text Case Converter', 'slug' => 'text-case-converter', 'category' => 'text-tools'],
            ['name' => 'Random Name Generator', 'slug' => 'random-name-generator', 'category' => 'utilities'],
            ['name' => 'Resume Builder', 'slug' => 'resume-builder', 'category' => 'documents'],
            ['name' => 'Invoice Generator', 'slug' => 'invoice-generator', 'category' => 'documents'],
            ['name' => 'O-Level Lesson Plan Generator (TIE Format)', 'slug' => 'lesson-plan-generator', 'category' => 'documents'],
        ];

        foreach ($tools as $tool) {
            $categoryId = $categoryMap->get($tool['category'])->id ?? null;

            DB::table('tools')->updateOrInsert(
                ['slug' => $tool['slug']],
                [
                    'name' => $tool['name'],
                    'category_id' => $categoryId,
                    'description' => null,
                    'icon' => null,
                    'is_active' => true,
                    'is_featured' => false,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
