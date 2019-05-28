<?php
return [
    'admin' => [
        'type' => 1,
        'description' => 'Site administrator',
        'children' => [
            'indexPartner',
            'viewPartner',
            'createPartner',
            'deletePartner',
            'updatePartner',
            'crudPerson',
            'indexUser',
            'viewUser',
            'createUser',
            'updateUser',
            'deleteUser',
            'partner',
            'test'
        ],
    ],
    'partner' => [
        'type' => 1,
        'description' => 'Partner company',
        'children' => [
            'viewOwnCompany',
            'createPerson',
            'crudOwnPerson',
            'viewOwnPersonsProfile',
            'person',
        ],
    ],
    'person' => [
        'type' => 1,
        'description' => 'Person of partner company',
        'children' => [
            'viewOwnJob',
            'viewOwnProfile',
            'test'
        ],
    ],
    'indexPartner' => [
        'type' => 2,
        'description' => 'Manage a partner',
    ],
    'test' => [
        'type' => 2,
        'description' => 'Test',
    ],
    'viewPartner' => [
        'type' => 2,
        'description' => 'View a partner',
    ],
    'updatePartner' => [
        'type' => 2,
        'description' => 'Update a partner',
    ],
    'createPartner' => [
        'type' => 2,
        'description' => 'Update a partner',
    ],
    'deletePartner' => [
        'type' => 2,
        'description' => 'Update a partner',
    ],
    'viewOwnCompany' => [
        'type' => 2,
        'description' => 'View own company',
        'ruleName' => 'isOwnCompany',
        'children' => [
            'viewPartner',
        ],
    ],
    'viewOwnJob' => [
        'type' => 2,
        'description' => 'View own company',
        'ruleName' => 'isOwnJob',
        'children' => [
            'viewPartner',
        ],
    ],
    'crudPerson' => [
        'type' => 2,
        'description' => 'Manage company person',
    ],
    'createPerson' => [
        'type' => 2,
        'description' => 'Manage company person',
    ],
    'crudOwnPerson' => [
        'type' => 2,
        'description' => 'Manage company person',
        'ruleName' => 'isOwnPerson',
        'children' => [
            'crudPerson',
        ],
    ],
    'indexUser' => [
        'type' => 2,
        'description' => 'Crud users',
    ],
    'viewUser' => [
        'type' => 2,
        'description' => 'View users profile',
    ],
    'createUser' => [
        'type' => 2,
        'description' => 'View users profile',
    ],
    'updateUser' => [
        'type' => 2,
        'description' => 'View users profile',
    ],
    'deleteUser' => [
        'type' => 2,
        'description' => 'View users profile',
    ],
    'viewOwnPersonsProfile' => [
        'type' => 2,
        'description' => 'View own persons profile',
        'ruleName' => 'isOwnPersonProfile',
        'children' => [
            'viewUser',
        ],
    ],
    'viewOwnProfile' => [
        'type' => 2,
        'description' => 'View own profile',
        'ruleName' => 'isOwnProfile',
        'children' => [
            'viewUser',
        ],
    ],
];
