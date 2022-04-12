<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Club;
use App\Models\College;
use App\Models\Course;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Level;
use App\Models\Package;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function seedLanguage()
    {
        $languages = ['Filipino', 'English'];
        foreach ($languages as $language) {
            Language::create(['name' => $language, 'country' => 'PH']);
        }
    }
    public function seedCollegeCoursesClubs()
    {
        $colleges = [
            'Integrated School',
            'Berkeley Business And Science',
            'Reagan Arts And Humanities',
        ];

        $courses = [
            ['Senior High School'],
            [
                'Sports Science',
                'Business and Corporate Management',
                'Sports Science',
                'Economics',
                'Accountancy',
                'Biology',
                'Nursing',
                'Intellectual Property',
                'Medicine',
                'Law',
            ],
            [
                'Dance',
                'Music',
                'Drama and Theater Arts',
                'Communication Arts (film, photography, film and video, print and broadcast)',
                'Fine and Studio Arts',
                'Design and Applied Arts',
                'History and Literature',
                'Linguistics',
                'Literature',
                'Foreign Languages',
                'International Studies',
                'Political Science',
                'Psychology',
                'Women\'s Studies',
            ],
        ];

        $clubs = [
            [
                'Junior BRAT',
                'Junior MAC',
                'Junior PAS',
                'Junior Innovators',
                'Junior MATHletes',
                'Philanthropist',
                'Talakayan',
                'Junior Roots',
                'Senior High Extremes',
                'Junior Maison',
                'Junior Entrepreneurs',
                'Junior Bibliophile',
                'Senior High Voyagers',
                'Junior Green Thumb',
                'Junior Furparents',
            ],
            [
                'BRU Athletics (BRAT)',
                'BRU Media Arts Club (BRU MAC)',
                'BRU Performing Arts Society (BRU PAS)',
                'BRU Innovators',
                'BRU Social Responsibility Club',
                'BRU Speech and Debate Club',
                'BRU Heritage Club',
                'BRU Extremes',
                'BRU Maison',
                'BRU Entrepreneurs',
                'BRU Bibliophiles',
                'BRU Voyagers',
                'BRU and Green',
                'BRU and Green',
            ],
            [
                'BRU Athletics (BRAT)',
                'BRU Media Arts Club (BRU MAC)',
                'BRU Performing Arts Society (BRU PAS)',
                'BRU Innovators',
                'BRU Social Responsibility Club',
                'BRU Speech and Debate Club',
                'BRU Heritage Club',
                'BRU Extremes',
                'BRU Maison',
                'BRU Entrepreneurs',
                'BRU Bibliophiles',
                'BRU Voyagers',
                'BRU and Green',
                'BRU and Green',
            ],
        ];

        foreach ($colleges as $key => $c) {
            $college = College::create(['name' => $c]);

            foreach ($courses[$key] as $value) {
                 Course::create(['college_id' => $college->id, 'name' => $value]);
            }

            foreach ($clubs[$key] as $value) {
                Club::create(['college_id' => $college->id, 'name' => $value]);
           }
        }
    }

    public function seedCategories()
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
        foreach ($bookCategories as $cat) {
            Category::create([ 'work_type' => Category::WORK_TYPE_AUDIO_BOOK, 'name' => $cat['name'], 'file_type' => Category::FILE_TYPE_AUDIO]);
        }
    }

    public function seedPackages()
    {
        $bulletins = [
            '3*100',
            '7*180',
            '30*750',
        ];
        $marquees = [
            '7*120',
            '30*510',
        ];
        $slidingBanner = [
            '3*300',
            '7*600',
            '30*2400',
        ];
        $messageBlast = [
            '1*100',
            '3*420',
        ];
        $loadingImage = [
            '3*100',
            '7*600',
            '30*2400',
        ];
        $newspaper = [
            '3*100',
            '7*180',
            '30*750',
        ];

        $packages = [ $bulletins, $marquees, $slidingBanner, $messageBlast, $loadingImage, $newspaper];
        $keys = [Package::TYPE_BULLETIN, Package::TYPE_MARQUEE, Package::TYPE_SLIDING_BANNER, Package::TYPE_MESSAGE_BLAST, Package::TYPE_LOADING_IMAGE, Package::TYPE_NEWSPAPER];
        foreach ($packages as $key => $package) {
            foreach ($package as $value) {
                [$days, $cost] = explode('*', $value);
                Package::create([
                    'type' => $keys[$key],
                    'number_of_days' => $days,
                    'cost' => $cost,
                ]);
            }
        }

    }

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
                    ],
                    [
                        'name' => '1*Violent',
                        'age' => 16,
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
                'violence' => []
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
                'violence' => []
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
                    [
                        'name' => '4*Gruesome',
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
                'violence' => []
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
                'violence' => []
            ],
        ];
        $songGenres = [
            'Pop',
            'Rock',
            'RnB',
            'OPM',
            'Jazz',
            'Classical',
            'Gospel',
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
        $this->seedCollegeCoursesClubs();
        $this->seedGenres();
        $this->seedCategories();
        $this->seedPackages();
        $this->seedLanguage();
    }
}
