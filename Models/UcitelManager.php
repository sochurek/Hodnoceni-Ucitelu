<?php
class UcitelManager
{
    public static function getAllUcitel(): array
    {
        return Db::query("
            SELECT skola.nazev, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id;");
    }

    public static function getUcitelByID(int $ID): array
    {
        return Db::query("
            SELECT skola.nazev,ucitel.id,ucitel.jmeno,ucitel.obrazek,ucitel.email
            FROM HU.skola
            INNER JOIN skola.id = ucitel.skola_id
            WHERE ucitel.id = :id", array(
            ":id" => $id,
        ));
    }
}
