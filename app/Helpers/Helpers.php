<?php

if (!function_exists('nombreDia')) {
    function nombreDia($numero)
    {
        $dias = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];

        return $dias[$numero] ?? 'Desconocido';
    }
}
