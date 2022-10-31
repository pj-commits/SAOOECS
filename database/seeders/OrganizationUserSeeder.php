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
                'user_id' => $user4,
                'organization_id' => $org1,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user5,
                'organization_id' => $org1,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user6,
                'organization_id' => $org1,
                'position'=>'Vice-President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user7,
                'organization_id' => $org1,
                'position'=>'Secretary',
                'role' => 'Editor',
            ],
            [
                'user_id' => $user8,
                'organization_id' => $org1,
                'position'=>'Treasurer',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user9,
                'organization_id' => $org1,
                'position'=>'Auditor',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user11,
                'organization_id' => $org1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user12,
                'organization_id' => $org1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user13,
                'organization_id' => $org1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user14,
                'organization_id' => $org1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user15,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user16,
                'organization_id' => $org1,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //Gaming Genesis
            [
                'user_id' => $user1,
                'organization_id' => $org2,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user11,
                'organization_id' => $org2,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user17,
                'organization_id' => $org2,
                'position'=>'Secretary',
                'role' => 'Editor',
            ],
            [
                'user_id' => $user18,
                'organization_id' => $org2,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user19,
                'organization_id' => $org2,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //APC Dance Company
            [
                'user_id' => $user10,
                'organization_id' => $org3,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user20,
                'organization_id' => $org3,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user21,
                'organization_id' => $org3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user22,
                'organization_id' => $org3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user23,
                'organization_id' => $org3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],
            [
                'user_id' => $user11,
                'organization_id' => $org3,
                'position'=>'Member',
                'role' => 'Viewer',
            ],

            //CodeSeekers
            [
                'user_id' => $user26,
                'organization_id' => $org4,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ],
            [
                'user_id' => $user27,
                'organization_id' => $org4,
                'position'=>'President',
                'role' => 'Moderator',
            ],

        ];

        DB::table('organization_user')->insert($orgusers);
    }
    
}
