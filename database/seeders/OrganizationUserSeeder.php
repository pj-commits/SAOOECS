<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgusers = [
            //Brewing Minds
            [
                'user_id' => 4,
                'organization_id' => 1,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 5,
                'organization_id' => 1,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 6,
                'organization_id' => 1,
                'position'=>'Vice-President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 7,
                'organization_id' => 1,
                'position'=>'Secretary',
                'role' => 'Editor',
            ],
            [
                'user_id' => 8,
                'organization_id' => 1,
                'position'=>'Treasurer',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 9,
                'organization_id' => 1,
                'position'=>'Auditor',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 11,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 12,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 13,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 14,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 15,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 16,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //Gaming Genesis
            [
                'user_id' => 1,
                'organization_id' => 2,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 11,
                'organization_id' => 2,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 17,
                'organization_id' => 2,
                'position'=>'Secretary',
                'role' => 'Editor',
            ],
            [
                'user_id' => 18,
                'organization_id' => 2,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 19,
                'organization_id' => 2,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //APC Dance Company
            [
                'user_id' => 10,
                'organization_id' => 3,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 20,
                'organization_id' => 3,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 21,
                'organization_id' => 3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 22,
                'organization_id' => 3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 23,
                'organization_id' => 3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => 11,
                'organization_id' => 3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //CodeSeekers
            [
                'user_id' => 26,
                'organization_id' => 4,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 27,
                'organization_id' => 4,
                'position'=>'President',
                'role' => 'Moderator',
            ],

        ];

        DB::table('organization_user')->insert($orgusers);
    }
    
}
