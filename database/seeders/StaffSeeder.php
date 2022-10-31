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
            //SAO
            [
                'user_id' => 1,
                'department_id' => 1,
                'position'=>'Head'
                
            ], 
            //Finance
            [
                'user_id' => 2,
                'department_id' => 2,
                'position'=> 'Head'
                
            ], 
            //AcadServ
            [
                'user_id' => 3,
                'department_id' => 3,
                'position'=> 'Head'
                
            ], 
            //Adviser - Sample Adviser
            [
                'user_id' => 4,
                'department_id' => 4,
                'position'=> 'Professor'
                
            ], 
            //Adviser
            [
                'user_id' => 10,
                'department_id' => 5,
                'position'=> 'Professor'
                
            ], 
            //Adviser - Codeseekers
            [
                'user_id' => 26,
                'department_id' => 6,
                'position'=> 'Professor'
                
            ], 
        ];

        foreach($staffs as $i){
            Staff::create($i);
        }
        
    }
}
