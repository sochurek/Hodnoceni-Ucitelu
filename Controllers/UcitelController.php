<?php

class UcitelController extends Controller
{
    function process($params)
    {

        // ID které se zjišťuje z URL
        $idcko = $params[0];

        // Data z DB potřebné pro funkci stránky
        $this->data["ucitel"] = UcitelManager::getUcitelByID($idcko);
        $this->data["hodnocenii"] = HodnoceniManager::getAllHodnoceniByID($idcko);
        $this->data["hvezdy"] = UcitelManager::getPrumHvezdUcitel($idcko);
        $dataa = UcitelManager::getUcitelByID($idcko);
        $this->data["idprohodnoceni"] = $params[0];

        // Header of page (title)
        $this->header["title"] = $dataa->jmeno;

        // Funkce která nahlásí hodnocení a následně refreshne stránku aby se hodnocení "smazalo"
        function reportHodnoceni($id, $iducitele)
        {
            HodnoceniManager::reportHodnoceni($id);
            header("Location: /ucitel/$iducitele");
            die();
        }

        // zavolá se funkce reportSkolaHodnoceni pokud se zmáčkné tlačítko "Nahlaš Hodnocení"
        if (array_key_exists('report', $_POST)) {
            reportHodnoceni($_POST["report_id"], $idcko);
        }

        // Setup layout
        $this->view = "ucitel";
    }
}
