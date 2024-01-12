<?php

return [

    'resource' => 'receta',
    'module' => 'Recetas',

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

];
