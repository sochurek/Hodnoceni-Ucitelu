<?php

class UcitelController extends Controller
{
    function process($params)
    {
        $this->data["ucitel"] = UcitelManager::getUcitelByID($params[0]);

        $dataa = UcitelManager::getUcitelByID($params[0]);

        // Header of page (title)
        $this->header["title"] = $dataa->jmeno;
        $this->header["description"] = "Výpis učitele $dataa->jmeno";

        // Setup layout
        $this->view = "ucitel";
        
    }
}
