<?php

return [

    'resource' => 'category',
    'module' => 'Categories',

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
    ]

];
