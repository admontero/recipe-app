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
        ]
    ],

    'components' => [
        'main-hero-card' => [
            'title' => 'Find your favorite recipe',
            'subtitle-1' => 'In Recipe we have a wide variety of recipes for all tastes, which you can access easily, quickly and clearly.',
            'subtitle-2' => 'Surprise your family, friends and guests with one of the published dishes, they will surely be satisfied.',
            'select' => 'Select a category...',
            'input' => 'What do you want to cook today?',
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
            'input' => 'Search recipe...',
        ],
        'categories-card' => [
            'title' => 'Categories',
            'empty' => 'There are no categories with published recipes.',
        ],
        'recipes-empty-alert' => [
            'message' => 'It seems that this category has no recipes published yet, dare to be the first to do it, maybe you will be a great chef!'
        ],
    ]

];
