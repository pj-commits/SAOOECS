<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffs = [
            [
                'user_id' => 1,
                'department_id' => 1,
                'position'=>'Sao Head'
                
            ], 
            [
                'user_id' =>2,
                'department_id' => 2,
                'position'=> 'Finance Head'
                
            ], 
            [
                'user_id' => 3,
                'department_id' => 3,
                'position'=> 'Academic Services Head'
                
            ], 
        ];

        foreach($staffs as $i){
            Staff::create($i);
        }
    }
}
