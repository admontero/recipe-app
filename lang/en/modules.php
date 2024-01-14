<?php

return [
    'category' => [
        'singular' => 'Category',
        'plural' => 'Categories',

        'index' => [
            'header' => 'Category Module',
            'title' => 'Categories',
            'description' => 'This module shows the categories of the recipes registered in the system.',
        ],

        'create' => [
            'header' => 'Category Creation',
            'title' => 'New Category',
            'description' => 'Fill in the required data to create a new recipe category.',
        ],

        'edit' => [
            'header' => 'Category Edition',
            'title' => 'Update Category',
            'description' => 'Update the required data to save the category.',
        ],

        'delete' => [
            'description' => 'Are you sure you want to delete the category?',
            'action' => 'Delete Category',
        ],

        'restore' => [
            'description' => 'Are you sure you want to restore the category?',
            'action' => 'Restore Category',
        ],

        'success' => [
            'saved' => 'The category has been deleted succesfully.',
            'deleted' => 'The category has been deleted succesfully.',
            'restored' => 'The category has been restored succesfully.',
        ]
    ],

    'profile' => [
        'edit' => [
            'alert' => 'The profile has been saved successfully.',
        ],

        'password' => [
            'alert' => 'The password has been successfully updated.',
        ],

        'delete' => [
            'title' => 'Are you sure you want to delete your account?',
            'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        ]
    ],

    'recipe' => [
        'singular' => 'Recipe',
        'plural' => 'Recipes',

        'index' => [
            'header' => 'Recipe Module',
            'title' => 'Recipes',
            'description' => 'This module shows the recipes registered in the system.',
        ],

        'create' => [
            'header' => 'Recipe Creation',
            'title' => 'New Recipe',
            'description' => 'Fill in the required data to create a new recipe.',
        ],

        'edit' => [
            'header' => 'Recipe Edition',
            'title' => 'Update Recipe',
            'description' => 'Update the required data to save the recipe.',
        ],

        'delete' => [
            'description' => 'Are you sure you want to delete the recipe?',
            'action' => 'Delete Recipe',
        ],

        'restore' => [
            'description' => 'Are you sure you want to restore the recipe?',
            'action' => 'Restore Recipe',
        ],

        'success' => [
            'saved' => 'The recipe has been deleted succesfully.',
            'deleted' => 'The recipe has been deleted succesfully.',
            'restored' => 'The recipe has been restored succesfully.',
        ]
    ],

    'user' => [
        'singular' => 'User',
        'plural' => 'Users',

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
    ],
];
