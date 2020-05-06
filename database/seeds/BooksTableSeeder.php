<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [

            [
               'ISBN' => '978-1491918661',
               'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
               'author' => 'Robin Nixon',
               'category' => 'PHP, Javascript',
               'price' => '9.99'
            ],
            [
               'ISBN' => '978-0596804848',
               'title' => 'Ubuntu: Up and Running: A Power Users Desktop Guide',
               'author' => 'Robin Nixon',
               'category' => 'Linux',
               'price' => '12.99'
            ],
            [
               'ISBN' => '978-1118999875',
               'title' => 'Linux Bible',
               'author' => 'Christopher Negus',
               'category' => 'Linux',
               'price' => '19.99'
            ],
            [
               'ISBN' => '978-0596517748',
               'title' => 'JavaScript: The Good Parts',
               'author' => 'Douglas Crockford',
               'category' => 'Javascript',
               'price' => '8.99'
            ]

        ];

        foreach ($books as $book) {
            DB::table('books')->insert($book);
        }
    }
}
