<?php

return [

    'resource' => 'usuario',
    'module' => 'Usuarios',

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

];
