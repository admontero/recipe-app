<?php

return [
    'navigation' => [
        'recipes' => 'My Recipes',
    ],

    'recipes' => [
        'show' => [
            'ingredients' => [
                'title' => 'Ingredients',
            ],
            'preparation' => [
                'title' => 'Preparation',
            ],
        ],
        'category-show' => [
            'title' => 'Recipes with the category',
            'empty' => 'It seems that this category has no recipes published yet, dare to be the first to do it, maybe you will be a great chef!',
        ],
        'tag-show' => [
            'title' => 'Recipes with the tag',
            'empty' => 'It seems that this tag has no recipes published yet, dare to be the first to do it, maybe you will be a great chef!',
        ],
        'user-show' => [
            'title' => 'Recipes from user',
            'empty' => 'There seem to be no recipes posted by this user, try again later or try another user.',
        ],
        'search-show' => [
            'title' => 'Recipes with the term',
            'empty' => 'There seems to be no results for your search, please try another term.',
        ],
    ],

    'components' => [
        'main-hero-card' => [
            'title' => 'Find your favorite recipe',
            'subtitle-1' => 'In Recipe we have a wide variety of recipes for all tastes, which you can access easily, quickly and clearly.',
            'subtitle-2' => 'Surprise your family, friends and guests with one of the published dishes, they will surely be satisfied.',
            'select' => 'Select a category...',
            'input' => 'What do you want to cook today?',
            'button' => 'Search Recipe',
        ],
        'categories-recipes-section' => [
            'anchor' => 'Show More'
        ],
        'recent-recipes-section' => [
            'title' => 'Recent Recipes'
        ],
        'tags-card' => [
            'title' => 'Tags',
            'empty' => 'This recipe doesn\'t have tags.',
        ],
        'recipe-search-card' => [
            'title' => 'Recipes Search',
            'input' => 'Write the name of a recipe...',
            'button' => 'Search',
        ],
        'categories-card' => [
            'title' => 'Categories',
            'empty' => 'There are no categories with published recipes.',
        ],
    ]

];
