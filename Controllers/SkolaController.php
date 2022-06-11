<?php

class SkolaController extends Controller
{
    function process($params)
    {

        // Id školy pro další potřeby (získává se z url)
        $id_skoly = $params[0];

        // škola podle ID z url (vytahuje se z DB)
        $dataaa = SchoolManager::getSchoolByID($params[0]);

        // Data z DB potřebné pro funkci stránky
        $this->data["school"] = SchoolManager::getSchoolByID($params[0]);
        $this->data["ucitele"] = UcitelManager::getUcitelBySchoolID($params[0]);
        $this->data["hodnoceniskola"] = HodnoceniManager::getAllHodnoceniSkolaByID($id_skoly);
        $this->data["hvezdy"] = SchoolManager::getPrumHvezdSkola($id_skoly);

        // Funkce která nahlásí hodnocení a následně refreshne stránku aby se hodnocení "smazalo"
        function reportSkolaHodnoceni($id, $id_skoly)
        {
            HodnoceniManager::reportHodnoceniSkola($id);
            header("Location: /skola/$id_skoly");
            die();
        }

        // zavolá se funkce reportSkolaHodnoceni pokud se zmáčkné tlačítko "Nahlaš Hodnocení"
        if (array_key_exists('report', $_POST)) {
            reportSkolaHodnoceni($_POST["report_id"], $id_skoly);
        }

        // Header of page (title)
        $this->header["title"] = $dataaa->nazev;


        // Setup layout
        $this->view = "skola";
    }
}
