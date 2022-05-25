<?php

class UcitelController extends Controller
{
    function process($params)
    {

        $idcko = $params[0];

        $this->data["ucitel"] = UcitelManager::getUcitelByID($idcko);
        $this->data["hodnocenii"] = HodnoceniManager::getAllHodnoceniByID($idcko);
        $this->data["hvezdy"] = UcitelManager::getPrumHvezdUcitel($idcko);
        $dataa = UcitelManager::getUcitelByID($idcko);

        $this->data["idprohodnoceni"] = $params[0];

        // Header of page (title)
        $this->header["title"] = $dataa->jmeno;
        $this->header["description"] = "Výpis učitele $dataa->jmeno";

        

        function reportHodnoceni($id, $iducitele)
        {
            HodnoceniManager::reportHodnoceni($id);
            header("Location: /ucitel/$iducitele");
            die();
        }

        if (array_key_exists('report', $_POST)) {
            reportHodnoceni($_POST["report_id"], $idcko);
        }


        // Setup layout
        $this->view = "ucitel";
    }
}
