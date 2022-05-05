<?php
class HodnoceniManager
{
    public static function getAllHodnoceniByID(int $ID): array
    {
        return Db::query(
            "
            SELECT *
            FROM HU.hodnoceni
            WHERE hodnoceni.ucitel_id = $ID
            ORDER BY hodnoceni.id DESC;"
        );
    }

    public static function getHodnoceniByID(int $ID)
    {
        $hodnoceni = Db::singleQuery(
            "
            SELECT *
            FROM HU.hodnoceni
            WHERE id = $ID"
        );

        return new Hodnoceni($hodnoceni["id"], $hodnoceni["ucitel_id"], $hodnoceni["pocet_hvezd"], $hodnoceni["zprava"]);
    }

    public static function insertHodnoceni(Hodnoceni $hodnoceni)
    {
        Db::singleQuery(
            "
            INSERT INTO HU.hodnoceni
            (ucitel_id, pocet_hvezd, zprava)
            VALUES ($hodnoceni->ucitel_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');"
        );


        $date = date("H:i:s");

        $to = "domca11221@gmail.com";
        $subject = "Hodnocení zapsáno do DB";


        $message = "
            Hodnocení pro id učitele:  $hodnoceni->ucitel_id \r\n
            Počet hvězd: $hodnoceni->pocet_hvezd \r\n
            Zpráva: $hodnoceni->zprava \r\n
            Odesláno: $date
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <domca11221@gmail.com>' . "\r\n";

        mail($to, $subject, $message, $headers);
    }

    public static function reportHodnoceni(int $ID)
    {
        $hodnoceni = HodnoceniManager::getHodnoceniByID($ID);

        Db::singleQuery(" 
        INSERT INTO HU.reportedHodnoceni
        (idhodnoceni,ucitel_id,pocet_hvezd,zprava)
        VALUES ($hodnoceni->id,$hodnoceni->ucitel_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');        
        ");

        Db::singleQuery("
        DELETE FROM HU.hodnoceni
        WHERE (id = $ID);
        ");

    }
}
