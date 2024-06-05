<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Laravel',
            'slug' => Str::slug('Laravel'),
        ]);

        Category::create([
            'name' => 'Tailwind CSS',
            'slug' => Str::slug('Tailwind CSS'),
        ]);

        Category::create([
            'name' => 'Alpine JS',
            'slug' => Str::slug('Alpine JS'),
        ]);

        Category::create([
            'name' => 'Livewire',
            'slug' => Str::slug('Livewire'),
        ]);
    }
}
