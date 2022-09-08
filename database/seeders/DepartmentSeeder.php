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
            [
                'name' => 'Sao',
            ], 
            [
                'name' => 'Finance',
            ],
            [
                'name' => 'Academic Services',
            ],
            [
                'name' => 'SOCIT',
            ]
        ];

        foreach($departments as $i){
            Department::create($i);
        }
    }
}
