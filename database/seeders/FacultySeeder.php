<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = [
            [
                'user_id' => 5,
                'department_id' => 4,
                'position'=>'Head'
                
            ], 
        ];

        foreach($faculties as $i){
            Faculty::create($i);
        }
    }
}
