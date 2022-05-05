<?php

class SkolaController extends Controller
{
    function process($params)
    {
        $this->data["school"] = SchoolManager::getSchoolByID($params[0]);
        $dataaa = SchoolManager::getSchoolByID($params[0]);
        $this->data["ucitele"] = UcitelManager::getUcitelBySchoolID($params[0]);

        // Header of page (title)
        $this->header["title"] = $dataaa->nazev;
        $this->header["description"] = "Výpis školy $dataaa->nazev";

        // Setup layout
        $this->view = "skola";
    }
}
