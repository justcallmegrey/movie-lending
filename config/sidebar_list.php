<?php

# Config for list of menus displayed on Sidebar

return [
    'movies' => [
        'name' => 'menu.movies.name',
        'route' => 'movies.index',
        'permission' => 'movies_read',
        'icon' => 'images/activity.svg',
        'show' => true
    ],
    'members' => [
        'name' => 'menu.members.name',
        'route' => 'members.index',
        'permission' => 'members_read',
        'icon' => 'images/activity.svg',
        'show' => true
    ],
    'lendings' => [
        'name' => 'menu.lendings.name',
        'route' => 'lendings.index',
        'permission' => 'lendings_read',
        'icon' => 'images/activity.svg',
        'show' => true
    ],
    'return' => [
        'name' => 'menu.returns.name',
        'route' => 'returns.index',
        'permission' => 'returns_read',
        'icon' => 'images/activity.svg',
        'show' => true
    ],
];
