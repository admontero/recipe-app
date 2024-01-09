<?php

return [

    'resource' => 'categoría',
    'module' => 'Categorías',

    'index' => [
        'header' => 'Módulo de Categorías',
        'title' => 'Categorías',
        'description' => 'En este módulo se muestran las categorías de las recetas registradas en el sistema.',
    ],

    'create' => [
        'header' => 'Creación de Categoría',
        'title' => 'Nueva Categoría',
        'description' => 'Completa los datos requeridos para crear una nueva categoría de recetas.',
    ],

    'edit' => [
        'header' => 'Edición de Categoría',
        'title' => 'Editar Categoría',
        'description' => 'Actualiza los datos requeridos para guardar la categoría.',
    ],

    'delete' => [
        'description' => '¿Está seguro de que desea eliminar la categoría?',
        'action' => 'Eliminar Categoría',
    ],

    'restore' => [
        'description' => '¿Está seguro de que desea restaurar la categoría?',
        'action' => 'Restaurar Categoría',
    ]

];
