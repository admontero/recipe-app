<?php

return [
    'category' => [
        'singular' => 'Categoría',
        'plural' => 'Categorías',

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
        ],

        'success' => [
            'saved' => 'La categoría se ha guardado correctamente.',
            'deleted' => 'La categoría se ha eliminado correctamente.',
            'restored' => 'La categoría se ha restaurado correctamente.',
        ],
    ],

    'profile' => [
        'edit' => [
            'alert' => 'El perfil se ha guardado correctamente.',
        ],

        'password' => [
            'alert' => 'La contraseña se ha actualizado correctamente.',
        ],

        'delete' => [
            'title' => '¿Seguro que quieres eliminar tu cuenta?',
            'description' => 'Una vez eliminada su cuenta, todos sus recursos y datos se borrarán permanentemente. Introduzca su contraseña para confirmar que desea eliminar definitivamente su cuenta.',
        ]
    ],

    'recipe' => [
        'singular' => 'Receta',
        'plural' => 'Recetas',

        'index' => [
            'header' => 'Módulo de Recetas',
            'title' => 'Recetas',
            'description' => 'En este módulo se muestran las recetas registradas en el sistema.',
        ],

        'create' => [
            'header' => 'Creación de Receta',
            'title' => 'Nueva Receta',
            'description' => 'Completa los datos requeridos para crear una nueva receta.',
        ],

        'edit' => [
            'header' => 'Edición de Receta',
            'title' => 'Editar Receta',
            'description' => 'Actualiza los datos requeridos para guardar la receta.',
        ],

        'delete' => [
            'description' => '¿Está seguro de que desea eliminar la receta?',
            'action' => 'Eliminar Receta',
        ],

        'restore' => [
            'description' => '¿Está seguro de que desea restaurar la receta?',
            'action' => 'Restaurar Receta',
        ],

        'success' => [
            'saved' => 'La receta se ha guardado correctamente.',
            'deleted' => 'La receta se ha eliminado correctamente.',
            'restored' => 'La receta se ha restaurado correctamente.',
        ],
    ],

    'user' => [
        'singular' => 'Usuario',
        'plural' => 'Usuarios',

        'index' => [
            'header' => 'Módulo de Usuarios',
            'title' => 'Usuarios',
            'description' => 'En este módulo se muestran los usuarios registrados en el sistema.',
        ],

        'create' => [
            'header' => 'Creación de Usuario',
            'title' => 'Nuevo Usuario',
            'description' => 'Completa los datos requeridos para crear un nuevo usuario.',
        ],

        'edit' => [
            'header' => 'Edición de Usuario',
            'title' => 'Editar Usuario',
            'description' => 'Actualiza los datos requeridos para guardar el usuario.',
        ],

        'delete' => [
            'description' => '¿Está seguro de que desea eliminar el usuario?',
            'action' => 'Eliminar Usuario',
        ],

        'success' => [
            'saved' => 'El usuario se ha guardado correctamente.',
            'deleted' => 'El usuario se ha eliminado correctamente.',
            'restored' => 'El usuario se ha restaurado correctamente.',
        ],

        'danger' => [
            'minimun' => 'Debe haber mínimo un administrador registrado en el sistema.',
        ]
    ]
];
