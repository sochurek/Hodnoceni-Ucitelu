<?php

class UciteleController extends Controller {
    function process($params) {
        // Header of page (title)
        $this->header["title"] = "Učitelé";
        $this->header["description"] = "Výpis učitelů";


        $this->data["ucitele"] = UcitelManager::getAllUcitel();

        // Setup layout
        $this->view = "ucitele";

    }
}



?>