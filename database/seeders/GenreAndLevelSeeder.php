<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Level;
use Illuminate\Database\Seeder;

class GenreAndLevelSeeder extends Seeder
{
    public function setLevel($value, $genre)
    {
        foreach ($value['heat'] as $heat) {
            [$number, $name] = explode('*', $heat['name']);
            Level::create(['type' => Level::TYPE_HEAT, 'number' => $number, 'name' => $name, 'genre_id' => $genre->id, 'age_restriction' => $heat['age']]);
        }
        foreach ($value['violence'] as $violence) {
            [$number, $name] = explode('*', $violence['name']);
            Level::create(['type' => Level::TYPE_VIOLENCE, 'number' => $number, 'name' => $name, 'genre_id' => $genre->id, 'age_restriction' => $violence['age']]);
        }
    }

    public function seedGenres()
    {
        $bookGenres = [
            "Children's Literature" => ['heat' => [], 'violence' => []],
            "Teen and Young Adult" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                    [
                        'name' => '5*Erotica',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ]
                ],
            ],
            "New Adult" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    // [
                    //     'name' => '4*Erotic Romance',
                    //     'age' => 18,
                    // ],
                    // [
                    //     'name' => '5*Erotica',
                    //     'age' => 18,
                    // ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                ]
            ],
            "Romance" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                    [
                        'name' => '5*Erotica',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                ]
            ],
            "Detective and Mystery" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                ],
            ],
            "Action" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Gruesome',
                        'age' => 18,
                    ],
                ],
            ],
            "Historical" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Gruesome',
                        'age' => 18,
                    ],
                ],
            ],
            "Thriller and Horror" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Gruesome',
                        'age' => 18,
                    ],
                ],
            ],
            "LGBTQIA+" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                    [
                        'name' => '5*Erotica',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                ]
            ],
            "Poetry" => [
                'heat' => [
                    [
                        'name' => '1*Sweet',
                        'age' => 0,
                    ],
                    [
                        'name' => '2*Romantic',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Steamy',
                        'age' => 18,
                    ],
                    [
                        'name' => '4*Erotic Romance',
                        'age' => 18,
                    ],
                    [
                        'name' => '5*Erotica',
                        'age' => 18,
                    ],
                ],
                'violence' => [
                    [
                        'name' => '1*Non Violent',
                        'age' => 0,
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
                    ],
                    [
                        'name' => '3*Bloody',
                        'age' => 18,
                    ],
                ]
            ],
        ];
        $songGenres = [
            'Country',
            'Pop',
            'Rock',
            'RnB',
            'Jazz',
            'Classical',
        ];

        $excludeInArts = ['Poetry'];

        foreach ($bookGenres as $key => $value) { // arts
           if (in_array($key, $excludeInArts)) {
               continue;
           }
           $genre = Genre::create(['name' => $key, 'type' => Genre::TYPE_ART]);
           $this->setLevel($value, $genre);
        }

        foreach ($bookGenres as $key => $value) { // books
            $genre = Genre::create(['name' => $key, 'type' => Genre::TYPE_TEXT]);
            $this->setLevel($value, $genre);
        }

        foreach ($songGenres as $value) { // songs
            Genre::create(['name' => $value, 'type' => Genre::TYPE_SONG]);
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedGenres();
    }
}
