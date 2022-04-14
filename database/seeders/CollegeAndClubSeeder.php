<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Course;
use App\Models\College;
use Illuminate\Database\Seeder;

class CollegeAndClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}
