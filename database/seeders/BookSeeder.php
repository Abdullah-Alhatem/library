<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = [
            "ISBN" => "1112223334445",
            "title" => "تيسير الأمور في ملء القدور",
            "price" => 1,
            "mortgage" => 10,
            "category_id" => 5
        ];
        Book::create($book);


        Book::factory(100)->create();
    }
}
