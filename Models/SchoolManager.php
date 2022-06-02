<?php
class SchoolManager
{
    public static function getAllSchools(): array
    {
        return Db::query("
            SELECT *
            FROM HU.skola");
    }

    public static function getSchoolByID(int $ID)
    {
        $skola = Db::singleQuery(
            "
            SELECT *
            FROM HU.skola
            WHERE id = $ID"
        );

        return new School($skola["id"], $skola["nazev"], $skola["obrazek"], $skola["adresa"], $skola["email"]);
    }

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
