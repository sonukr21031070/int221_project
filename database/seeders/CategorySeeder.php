<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mathematics',
                'description' => 'Resources for learning mathematics, including algebra, geometry, calculus, and statistics.',
            ],
            [
                'name' => 'Science',
                'description' => 'Educational materials covering physics, chemistry, biology, and other scientific disciplines.',
            ],
            [
                'name' => 'Languages',
                'description' => 'Resources for learning different languages, including grammar, vocabulary, and pronunciation.',
            ],
            [
                'name' => 'History',
                'description' => 'Materials covering historical events, periods, and civilizations.',
            ],
            [
                'name' => 'Arts & Music',
                'description' => 'Resources for learning about art, music, and creative expression.',
            ],
            [
                'name' => 'Computer Science',
                'description' => 'Educational materials about programming, algorithms, and computer systems.',
            ],
            [
                'name' => 'Social Studies',
                'description' => 'Resources covering geography, civics, economics, and social sciences.',
            ],
            [
                'name' => 'Special Education',
                'description' => 'Materials specifically designed for students with special needs.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
} 