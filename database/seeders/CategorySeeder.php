<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // books
        $bookCategories = [
            [
                'name' => 'Novel',
                'file_type' => Category::FILE_TYPE_TEXT,
            ],
            [
                'name' => 'Illustrated Novel',
                'file_type' => Category::FILE_TYPE_PDF,
            ],
            [
                'name' => 'Picture Book',
                'file_type' => Category::FILE_TYPE_PDF,
            ],
            [
                'name' => 'Comic Book',
                'file_type' => Category::FILE_TYPE_PDF,
            ],
            [
                'name' => 'Anthology',
                'file_type' => Category::FILE_TYPE_TEXT,
            ],
        ];

        foreach ($bookCategories as $cat) {
            Category::create([ 'work_type' => Category::WORK_TYPE_BOOK, 'name' => $cat['name'], 'file_type' => $cat['file_type']]);
        }

        $audioBookCategories = [
            [
                'name' => 'Novel',
                'file_type' => Category::FILE_TYPE_AUDIO,
            ],
            [
                'name' => 'Anthology',
                'file_type' => Category::FILE_TYPE_AUDIO,
            ],
        ];
        foreach ($audioBookCategories as $cat) {
            Category::create([ 'work_type' => Category::WORK_TYPE_AUDIO_BOOK, 'name' => $cat['name'], 'file_type' => Category::FILE_TYPE_AUDIO]);
        }
    }
}
