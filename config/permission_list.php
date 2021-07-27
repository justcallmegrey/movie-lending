<?php

# Config for list of roles, permissions, and default permission assignment for each role

return [
    'role' => ['admin'],
    'permission_list' => [
        'home' => [
            'home_read',
        ],
        'movies' => [
            'movies_read',
            'movies_create',
            'movies_edit',
            'movies_delete',
        ],
        'members' => [
            'members_read',
            'members_create',
            'members_edit',
            'members_delete',
        ],
        'lendings' => [
            'lendings_read',
            'lendings_create',
        ],
        'return' => [
            'returns_read',
            'returns_return',
        ],
    ],
    'admin' => [
        'home_read',
        'movies_read',
        'movies_create',
        'movies_edit',
        'movies_delete',
        'members_read',
        'members_create',
        'members_edit',
        'members_delete',
        'lendings_read',
        'lendings_create',
        'returns_read',
        'returns_return',
    ],
];
