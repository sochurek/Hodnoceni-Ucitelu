<?php

// Třída pro příkazy které přistupují k databázi pro práci s učiteli
class UcitelManager
{

    // Metoda, která vypíše všechny učitele z DB v arrayi
    public static function getAllUcitel(): array
    {
        return Db::query(
            "
            SELECT skola.nazev, skola.id as skola_id, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id;"
        );
    }

    // Metoda, která vypíše určitého učitele podle ID
    public static function getUcitelByID(int $ID)
    {
        $ucitel = Db::singleQuery("
            SELECT skola.nazev, skola.id as skola_id,ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id
            WHERE ucitel.id = $ID;");

        return new Ucitel($ucitel["nazev"], $ucitel["skola_id"], $ucitel["id"], $ucitel["jmeno"], $ucitel["obrazek"], $ucitel["email"]);
    }

    // Metoda, která vypíše všechny učitele, kteří patří k určité škole podle skola_id
    public static function getUcitelBySchoolID(int $ID): array
    {
        return Db::query("
            SELECT skola.nazev, skola.id as skola_id, ucitel.id, ucitel.jmeno, ucitel.obrazek, ucitel.email
            FROM HU.skola
            INNER JOIN ucitel on skola.id = ucitel.skola_id
            WHERE ucitel.skola_id = $ID;");
    }

    // Metoda, která získá průměrný počet hvězd učitele podle ID
    public static function getPrumHvezdUcitel(int $ID)
    {
        $hvezdy = Db::singleQuery(
            "
            SELECT sum(hodnoceni.pocet_hvezd)/count(hodnoceni.ucitel_id) as prumer
            FROM HU.hodnoceni
            WHERE ucitel_id = $ID;"
        );
        return $hvezdy["prumer"];
    }
}
