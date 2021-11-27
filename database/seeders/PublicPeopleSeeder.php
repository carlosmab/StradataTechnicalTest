<?php

namespace Database\Seeders;

use App\Models\PublicPerson;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class PublicPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PublicPerson::truncate();

        $csvFile = fopen(base_path("database/data/public_people.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                PublicPerson::create([
                    "uuid" => Uuid::uuid4()->toString(),
                    "region" => $data['0'],
                    "location" => $data['1'],
                    "city" => $data['2'],
                    "name" => $data['3'],
                    "active_years" => $data['4'],
                    "person_type" => $data['5'],
                    "job_title" => $data['6']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
