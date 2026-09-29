<?php

namespace App\Support;

/**
 * Convierte los campos de texto del mantenedor (valores separados por coma o punto y coma)
 * en listas limpias para las vistas.
 */
final class Lista
{
    /** @return list<string> */
    public static function separar(?string $texto, string $separador = ','): array
    {
        if ($texto === null || trim($texto) === '') {
            return [];
        }

        $items = array_map('trim', explode($separador, $texto));

        return array_values(array_filter($items, fn (string $item) => $item !== ''));
    }
}
