<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Period;
use App\Models\Room;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PmpBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = Period::create([
            'year' => 2023,
            'semester' => 2,
            'active' => 1,
        ]);
        //Building Room
        for ($asciiCode = 65; $asciiCode <= 74; $asciiCode++) {
            $building = Building::create([
                'name' => chr($asciiCode),
                'floors' => 2,
            ]);

            for ($idx = 1; $idx <= $building->floors; $idx++) {
                for ($idy = 1; $idy <= 10; $idy++) {
                    Room::create([
                        'building_id' => $building->id,
                        'name' => $building->name.$idx.'.'.$idy,
                        'floor' => $idx,
                        'number' => $idy,
                    ]);
                }
            }
        }
        //Faculty - Department

        $faculty = Faculty::create([
            'name' => 'Teknologi Informasi',
            'abbreviation' => 'FTI',
            'type' => 1,
        ]);

        $faker = Faker::create('id_ID');
        $departments = [
            [
                'name' => 'Sistem Informasi',
                'faculty_id' => $faculty->id,
                'abbreviation' => 'DSI',
                'national_code' => $faker->word(),
            ],
            [
                'name' => 'Teknik Komputer',
                'faculty_id' => $faculty->id,
                'abbreviation' => 'DTK',
                'national_code' => $faker->word(),
            ],
            [
                'name' => 'Teknik Informatika',
                'faculty_id' => $faculty->id,
                'abbreviation' => 'DTI',
                'national_code' => $faker->word(),
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
