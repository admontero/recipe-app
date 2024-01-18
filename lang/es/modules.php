<?php

return [
    'category' => [
        'singular' => 'Categoría',
        'plural' => 'Categorías',

        'index' => [
            'header' => 'Módulo de Categorías',
            'title' => 'Categorías',
            'description' => 'En este módulo se muestran las categorías de las recetas registradas.',
            'empty' => 'No hay categorías creadas hasta este momento.',
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

    'comment' => [
        'singular' => 'Comentario',
        'plural' => 'Comentarios',
        'choice' => 'Comentario|Comentarios',

        'index' => [
            'empty' => 'Aún no hay comentarios.',
        ],

        'create' => [
            'login' => ':login para comentar o :register si aún no tienes cuenta.',
            'placeholder' => '¿Qué piensas de esta receta?',
            'button' => 'Enviar Comentario',
        ],

        'edit' => [
            'title' => 'Editar Comentario',
        ],

        'delete' => [
            'description' => '¿Está seguro de que desea eliminar el comentario?',
            'action' => 'Eliminar Comentario',
        ],
    ],

    'favorite' => [
        'singular' => 'Favorito',
        'plural' => 'Favoritos',
        'choice' => 'Favorito|Favoritos',
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
            'empty' => 'No hay recetas creadas hasta este momento.',
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
            'empty' => 'No hay usuarios creados hasta este momento.',
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
