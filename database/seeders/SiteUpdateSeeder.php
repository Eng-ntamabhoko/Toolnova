<?php

namespace Database\Seeders;

use App\Models\SiteUpdate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteUpdateSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $updates = [
            [
                'title' => 'CV Builder added',
                'slug' => 'cv-builder-added',
                'excerpt' => 'Create a modern CV online, download PDF and keep your resume ready for every application.',
                'update_type' => 'New Tool',
                'link' => url('/tools/cv-builder'),
                'sort_order' => 1,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Comments & Feedback system launched',
                'slug' => 'comments-feedback-system-launched',
                'excerpt' => 'Share feedback, report issues, and help shape the next ToolNova improvements.',
                'update_type' => 'Feature Update',
                'link' => url('/contact'),
                'sort_order' => 2,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Privacy Policy and About pages added',
                'slug' => 'privacy-policy-about-pages-added',
                'excerpt' => 'New public pages make it easier to learn about ToolNova and our data practices.',
                'update_type' => 'Improvement',
                'link' => url('/privacy'),
                'sort_order' => 3,
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($updates as $update) {
            SiteUpdate::create($update);
        }
    }
}
