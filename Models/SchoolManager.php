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
        $skola = Db::singleQuery("
            SELECT *
            FROM HU.skola
            WHERE id = $ID"
        );

        return new Ucitel($skola["id"],$skola["obrazek"], $skola["adresa"],$skola["email"],$skola["email"]);
    }
}
