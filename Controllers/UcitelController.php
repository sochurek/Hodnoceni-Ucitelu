<?php

class UcitelController extends Controller
{
    function process($params)
    {

        $idcko = $params[0];

        $this->data["ucitel"] = UcitelManager::getUcitelByID($idcko);
        $this->data["hodnocenii"] = HodnoceniManager::getAllHodnoceniByID($idcko);
        $dataa = UcitelManager::getUcitelByID($idcko);

        $this->data["idprohodnoceni"] = $params[0];

        // Header of page (title)
        $this->header["title"] = $dataa->jmeno;
        $this->header["description"] = "Výpis učitele $dataa->jmeno";

        // Setup layout
        $this->view = "ucitel";
    }
}
