<?php

return [

    'resource' => 'user',
    'module' => 'Users',

    'index' => [
        'header' => 'User Module',
        'title' => 'Users',
        'description' => 'This module shows the users registered in the system.',
    ],

    'create' => [
        'header' => 'User Creation',
        'title' => 'New User',
        'description' => 'Fill in the required data to create a new user.',
    ],

    'edit' => [
        'header' => 'User Edition',
        'title' => 'Update User',
        'description' => 'Update the required data to save the user.',
    ],

    'delete' => [
        'description' => 'Are you sure you want to delete the user?',
        'action' => 'Delete User',
    ],

    'success' => [
        'saved' => 'The user has been deleted succesfully.',
        'deleted' => 'The user has been deleted succesfully.',
        'restored' => 'The user has been restored succesfully.',
    ],

    'danger' => [
        'minimun' => 'There must be at least one administrator registered in the system.',
    ]

];
