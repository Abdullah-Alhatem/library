<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'نجيب محفوظ'],
            ['name' => 'طه حسين'],
            ['name' => 'عباس العقاد'],
            ['name' => 'أحمد شوقي'],
            ['name' => 'محمود درويش'],
        ];

        Author::insert($authors);
    }
}
