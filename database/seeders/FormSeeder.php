<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            ['name' => 'Form I', 'sort_order' => 1],
            ['name' => 'Form II', 'sort_order' => 2],
            ['name' => 'Form III', 'sort_order' => 3],
            ['name' => 'Form IV', 'sort_order' => 4],
        ];

        foreach ($forms as $form) {
            Form::updateOrCreate(
                ['name' => $form['name']],
                $form + ['is_active' => true]
            );
        }
    }
}
