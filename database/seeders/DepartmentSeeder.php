<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            //1
            [
                'name' => 'Student Activities Office',
            ], 
            //2
            [
                'name' => 'Finance Office',
            ],
            //3
            [
                'name' => 'Academic Services',
            ],
            //4
            [
                'name' => 'School of Computing and Information Technology',
            ],
            //5
            [
                'name' => 'School of Multimedia and Arts',
            ],
            //6
            [
                'name' => 'School of Management',
            ],
            //7
            [
                'name' => 'School of Engineering',
            ],
        ];

        foreach($departments as $i){
            Department::create($i);
        }
    }
}
