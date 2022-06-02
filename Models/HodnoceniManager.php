<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/src/Exception.php';
require 'vendor/src/PHPMailer.php';
require 'vendor/src/SMTP.php';

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



        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        Db::singleQuery(
            "
            INSERT INTO HU.hodnoceni
            (ucitel_id, pocet_hvezd, zprava)
            VALUES ($hodnoceni->ucitel_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');"
        );

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $date = date("H:i:s");
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';


        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');


        $mail->isHTML(false);
        $mail->Subject = 'Hodnocení zapsáno do DB';
        $mail->Body    = "Hodnocení pro id učitele:  $hodnoceni->ucitel_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        $mail->send();
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

    public static function getAllHodnoceniSkolaByID(int $ID): array
    {
        return Db::query(
            "
            SELECT *
            FROM HU.skolaHodnoceni
            WHERE skolaHodnoceni.skola_id = $ID
            ORDER BY skolaHodnoceni.id DESC;"
        );
    }

    public static function getHodnoceniSkolaByID(int $ID)
    {
        $hodnoceni = Db::singleQuery(
            "
            SELECT *
            FROM HU.skolaHodnoceni
            WHERE skolaHodnoceni.id = $ID"
        );

        return new HodnoceniSkola($hodnoceni["id"], $hodnoceni["skola_id"], $hodnoceni["pocet_hvezd"], $hodnoceni["zprava"]);
    }

    public static function insertHodnoceniSkola(HodnoceniSkola $hodnoceni)
    {

        $mail = new PHPMailer(true);

        Db::singleQuery(
            "
            INSERT INTO HU.skolaHodnoceni
            (skola_id, pocet_hvezd, zprava)
            VALUES ($hodnoceni->skola_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');"
        );


        $mail = new PHPMailer(true);

        $date = date("H:i:s");

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';


        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');


        $mail->isHTML(false);
        $mail->Subject = 'Hodnocení zapsáno do DB';
        $mail->Body    = "Hodnocení pro id školy:  $hodnoceni->skola_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        $mail->send();
    }

    public static function reportHodnoceniSkola(int $ID)
    {
        $hodnoceni = HodnoceniManager::getHodnoceniSkolaByID($ID);

        Db::singleQuery(" 
        INSERT INTO HU.reportedSkolaHodnoceni
        (idhodnoceni,skola_id,pocet_hvezd,zprava)
        VALUES ($hodnoceni->id,$hodnoceni->skola_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');        
        ");

        Db::singleQuery("
        DELETE FROM HU.skolaHodnoceni
        WHERE (skolaHodnoceni.id = $ID);
        ");
    }
}
