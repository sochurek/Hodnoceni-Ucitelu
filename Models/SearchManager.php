<?php

// Třída pro příkazy které přistupují k databázi pro Vyhledávání učitelů
class SearchManager
{

    // Metoda, která si vytáhne z DB všechny učitele, kteří se jménem podobají inputu
    public static function getSearch($search): array
    {
        return Db::query(
            "
        SELECT skola.nazev, skola.id as skola_id, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
        FROM HU.skola
        INNER JOIN ucitel on skola.id = ucitel.skola_id
        WHERE ucitel.jmeno like '%$search%'
        ORDER BY ucitel.jmeno ASC;"
        );
    }
}
