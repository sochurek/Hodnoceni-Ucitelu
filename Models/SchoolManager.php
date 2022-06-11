<?php

// Třída pro příkazy které přistupují k databázi pro práci se školami
class SchoolManager
{

    // Metoda, která vypíše všechny školy z DB v arrayi
    public static function getAllSchools(): array
    {
        return Db::query("
            SELECT *
            FROM HU.skola");
    }

    // Metoda, která vypíše určitou školu podle ID
    public static function getSchoolByID(int $ID)
    {
        $skola = Db::singleQuery(
            "
            SELECT *
            FROM HU.skola
            WHERE id = $ID"
        );

        return new School($skola["id"], $skola["nazev"], $skola["obrazek"], $skola["adresa"], $skola["email"], $skola["webpage"]);
    }

    // Metoda, která získá průměrný počet hvězd školy podle ID
    public static function getPrumHvezdSkola(int $ID)
    {
        $hvezdy = Db::singleQuery(
            "
            SELECT sum(skolaHodnoceni.pocet_hvezd)/count(skolaHodnoceni.skola_id) as prumer
            FROM HU.skolaHodnoceni
            WHERE skola_id = $ID;"
        );
        return $hvezdy["prumer"];
    }
}
