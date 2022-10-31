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
                'user_id' => $user1,
                'department_id' => $dept1,
                'position'=>'Head'
                
            ], 
            //Finance
            [
                'user_id' => $user2,
                'department_id' => $dept2,
                'position'=> 'Head'
                
            ], 
            //AcadServ
            [
                'user_id' => $user3,
                'department_id' => $dept3,
                'position'=> 'Head'
                
            ], 
            //Adviser - Sample Adviser
            [
                'user_id' => $user4,
                'department_id' => $dept4,
                'position'=> 'Professor'
                
            ], 
            //Adviser
            [
                'user_id' => $user10,
                'department_id' => $dept5,
                'position'=> 'Professor'
                
            ], 
            //Adviser - Codeseekers
            [
                'user_id' => $user26,
                'department_id' => $dept6,
                'position'=> 'Professor'
                
            ], 
        ];

        foreach($staffs as $i){
            Staff::create($i);
        }
        
    }
}
