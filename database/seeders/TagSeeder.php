<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => Str::slug('Laravel'),
        ]);

        Tag::create([
            'name' => 'Tailwind CSS',
            'slug' => Str::slug('Tailwind CSS'),
        ]);

        Tag::create([
            'name' => 'Alpine JS',
            'slug' => Str::slug('Alpine JS'),
        ]);

        Tag::create([
            'name' => 'Livewire',
            'slug' => Str::slug('Livewire'),
        ]);
    }
}
