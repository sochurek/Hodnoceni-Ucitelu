<?php

class SkolyController extends Controller {
    function process($params) {
        // Header of page (title)
        $this->header["title"] = "Školy";
        $this->header["description"] = "Výpis škol";


        $this->data["schools"] = SchoolManager::getAllSchools();

        // Setup layout
        $this->view = "skoly";

    }
}
