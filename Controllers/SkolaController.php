<?php

class SkolaController extends Controller
{
    function process($params)
    {

        $id_skoly = $params[0];
        $dataaa = SchoolManager::getSchoolByID($params[0]);


        $this->data["school"] = SchoolManager::getSchoolByID($params[0]);
        $this->data["ucitele"] = UcitelManager::getUcitelBySchoolID($params[0]);
        $this->data["hodnoceniskola"] = HodnoceniManager::getAllHodnoceniSkolaByID($id_skoly);
        $this->data["hvezdy"] = SchoolManager::getPrumHvezdSkola($id_skoly);

        function reportSkolaHodnoceni($id, $id_skoly)
        {
            HodnoceniManager::reportHodnoceniSkola($id);
            header("Location: /skola/$id_skoly");
            die();
        }

        if (array_key_exists('report', $_POST)) {
            reportSkolaHodnoceni($_POST["report_id"], $id_skoly);
        }

        // Header of page (title)
        $this->header["title"] = $dataaa->nazev;


        // Setup layout
        $this->view = "skola";
    }
}
