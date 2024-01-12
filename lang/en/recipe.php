<?php

return [

    'resource' => 'recipe',
    'module' => 'Recipes',

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

];
