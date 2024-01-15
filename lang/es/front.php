<?php

return [
    'navigation' => [
        'recipes' => 'Mis Recetas',
        'favorites' => 'Mis Favoritas',
        'new-recipe' => 'Crear Receta',
    ],

    'recipes' => [
        'index' => [
            'title' => 'Mis Recetas',
            'empty' => 'Al parecer no tienes recetas publicadas actualmente. Anímate a crear una para luego publicarla.',
        ],
        'show' => [
            'ingredients' => [
                'title' => 'Ingredientes',
            ],
            'preparation' => [
                'title' => 'Preparación',
            ],
            'favorites' => 'Favoritos',
        ],
        'category-show' => [
            'title' => 'Recetas con la categoría',
            'empty' => 'Parece que esta categoría aún no tiene recetas publicadas, atrévete a ser el primero en hacerlo, ¡quizá seas un gran chef!',
        ],
        'tag-show' => [
            'title' => 'Recetas con la etiqueta',
            'empty' => 'Parece que esta etiqueta aún no tiene recetas publicadas, atrévete a ser el primero en hacerlo, ¡quizá seas un gran chef!',
        ],
        'user-show' => [
            'title' => 'Recetas del usuario',
            'empty' => 'Parece que no hay recetas publicadas por este usuario, inténtelo más tarde o pruebe con otro usuario.',
        ],
        'search-show' => [
            'title' => 'Recetas con el término',
            'empty' => 'Parece que no hay resultados para su búsqueda, por favor intente con otro término.',
        ],
        'favorite-show' => [
            'title' => 'Mis Recetas Favoritas',
            'empty' => 'Parece que no tienes recetas favoritas aún, revisa la página principal para encontrarlas.',
        ],
    ],

    'components' => [
        'main-hero-card' => [
            'title' => 'Encuentra tu receta favorita',
            'subtitle-1' => 'En Recipe contamos con una gran variedad de recetas para todos los gustos, a las que podrás acceder de manera fácil, rápida y clara.',
            'subtitle-2' => 'Sorprende a tu familia, amigos e invitados con uno de los platos publicados, de seguro quedarán satisfechos.',
            'select' => 'Selecciona una categoría...',
            'input' => '¿Qué quieres cocinar hoy?',
            'button' => 'Buscar Receta',
        ],
        'categories-recipes-section' => [
            'anchor' => 'Mostrar Más'
        ],
        'recent-recipes-section' => [
            'title' => 'Recetas Recientes'
        ],
        'popular-recipes-section' => [
            'title' => 'Recetas Populares'
        ],
        'tags-card' => [
            'title' => 'Etiquetas',
            'empty' => 'Esta receta no tiene etiquetas.',
        ],
        'recipe-search-card' => [
            'title' => 'Búsqueda de Recetas',
            'input' => 'Escribe el nombre de alguna receta...',
            'button' => 'Buscar',
        ],
        'categories-card' => [
            'title' => 'Categorías',
            'empty' => 'No hay categorías con recetas publicadas.',
        ],
    ],

];
