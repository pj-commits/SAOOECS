<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'root' => 'root' ,
        'sao' => 'sao',
        'finance' => 'finance',
        'acadserv' => 'acadserv',
        'adviser' => 'adviser',
        'moderator'  => 'president',
        'editor' => 'secretary',
        'viewer' => 'member',
        'guest' => 'guest'
    ],
    
    'departments' =>[
        'Finance',
        'SOCIT',
        'Academic Services'
    ]

];
