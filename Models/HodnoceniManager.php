<?php

// Instance které se používají v této Classe
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Soubory potřebné pro správné fungování pluginu PHPMailer
require 'lib/src/Exception.php';
require 'lib/src/PHPMailer.php';
require 'lib/src/SMTP.php';

// Metoda, která pracuje s Hodnoceními Učitelů / Škol
class HodnoceniManager
{

    // Metoda, která vypíše všechny hodnocení konkrétního učitele od nejnovějšího po nejstarší
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

    // Metoda, která vypíše hodnocení podle ID hodnocení
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


    // Metoda, která vlozí validní hodnocení do DB
    public static function insertHodnoceni(Hodnoceni $hodnoceni)
    {

        Db::singleQuery(
            "
            INSERT INTO HU.hodnoceni
            (ucitel_id, pocet_hvezd, zprava)
            VALUES ($hodnoceni->ucitel_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');"
        );

        // Založí se mail, který se pošle adminovi stránky
        $mail = new PHPMailer(true);

        // Proměnná s časem zápisu hodnocení do DB
        $date = date("H:i:s");

        // Serverová nastavení
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('cs', '/lib/phpmailer.lang-cs.php');

        // Nastavení odesílatele a příjemce
        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');

        // Nastavení obsahu emailu
        $mail->isHTML(false);
        $mail->Subject = 'Hodnocení zapsáno do DB';
        $mail->Body    = "Hodnocení pro id učitele:  $hodnoceni->ucitel_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        // Poslání emailu
        $mail->send();
    }

    // Metoda, která vymaže nahlášené hodnocení z hlavní DB a zapíše ho do záložní DB
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

    // Metoda, která pošle nevalidní hodnocení na email admina
    public static function invalidHodnoceni(Hodnoceni $hodnoceni)
    {

        // Založí se mail, který se pošle adminovi stránky
        $mail = new PHPMailer(true);

        // Proměnná s časem zápisu hodnocení do DB
        $date = date("H:i:s");

        // Serverová nastavení
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('cs', '/lib/phpmailer.lang-cs.php');

        // Nastavení odesílatele a příjemce
        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');

        // Nastavení obsahu emailu
        $mail->isHTML(false);
        $mail->Subject = '[SPROSTÉ SLOVO] Hodnocení NEZAPSÁNO do DB';
        $mail->Body    = "Hodnocení pro id učitele:  $hodnoceni->ucitel_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        // Poslání emailu
        $mail->send();
    }

    // Metoda, která vypíše všechny hodnocení podle ID školy od nejnovějšího
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

    // Metoda, která vypíše hodnocení školy podle ID hodnocení školy
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

    // Metoda, která vlozí validní hodnocení školy do DB
    public static function insertHodnoceniSkola(HodnoceniSkola $hodnoceni)
    {

        Db::singleQuery(
            "
            INSERT INTO HU.skolaHodnoceni
            (skola_id, pocet_hvezd, zprava)
            VALUES ($hodnoceni->skola_id,$hodnoceni->pocet_hvezd,'$hodnoceni->zprava');"
        );

        // Založí se mail, který se pošle adminovi stránky
        $mail = new PHPMailer(true);

        // Proměnná s časem zápisu hodnocení do DB
        $date = date("H:i:s");

        // Serverová nastavení
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('cs', '/lib/phpmailer.lang-cs.php');

        // Nastavení odesílatele a příjemce
        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');

        // Nastavení obsahu emailu
        $mail->isHTML(false);
        $mail->Subject = 'Hodnocení zapsáno do DB';
        $mail->Body    = "Hodnocení pro id školy:  $hodnoceni->skola_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        // Poslání emailu
        $mail->send();
    }

    // Metoda, která vymaže nahlášené hodnocení školy z hlavní DB a zapíše ho do záložní DB
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

    // Metoda, která pošle nevalidní hodnocení ěkoly na email admina
    public static function invalidHodnoceniSkola(HodnoceniSkola $hodnoceni)
    {

        // Založí se mail, který se pošle adminovi stránky
        $mail = new PHPMailer(true);

        // Proměnná s časem zápisu hodnocení do DB
        $date = date("H:i:s");

        // Serverová nastavení
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.seznam.cz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hu@kevizb.cz';
        $mail->Password   = 'test123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('cs', '/lib/phpmailer.lang-cs.php');

        // Nastavení odesílatele a příjemce
        $mail->setFrom('hu@kevizb.cz', 'Hodnocení Učitelů');
        $mail->addAddress('domca11221@gmail.com', 'Dominik Sochůrek');

        // Nastavení obsahu emailu
        $mail->isHTML(false);
        $mail->Subject = '[SPROSTÉ SLOVO] Hodnocení NEZAPSÁNO do DB';
        $mail->Body    = "Hodnocení pro id školy:  $hodnoceni->skola_id \r\nPočet hvězd: $hodnoceni->pocet_hvezd \r\nZpráva: $hodnoceni->zprava \r\nOdesláno: $date";

        // Poslání emailu
        $mail->send();
    }
}
