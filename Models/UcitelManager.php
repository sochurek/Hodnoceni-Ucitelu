<?php
class UcitelManager
{
    public static function getAllUcitel(): array
    {
        return Db::query(
            "
            SELECT skola.nazev, skola.id as skola_id, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id;"
        );
    }

    public static function getUcitelByID(int $ID)
    {
        $ucitel = Db::singleQuery("
            SELECT skola.nazev, skola.id as skola_id,ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id
            WHERE ucitel.id = $ID;");

        return new Ucitel($ucitel["nazev"], $ucitel["skola_id"], $ucitel["id"], $ucitel["jmeno"], $ucitel["obrazek"], $ucitel["email"]);
    }

    public static function getUcitelBySchoolID(int $ID): array
    {
        return Db::query("
            SELECT skola.nazev, skola.id as skola_id, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id
            WHERE ucitel.skola_id = $ID;");
    }

    public static function getPrumHvezdUcitel(int $ID)
    {
        $hvezdy = Db::singleQuery("
            SELECT sum(hodnoceni.pocet_hvezd)/count(hodnoceni.ucitel_id) as prumer
            FROM HU.hodnoceni
            WHERE ucitel_id = $ID;"
        );
        return $hvezdy["prumer"];
    }
}
