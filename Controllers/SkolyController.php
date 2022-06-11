<?php

class SkolyController extends Controller {
    function process($params) {

        // Header of page (title)
        $this->header["title"] = "Školy";

        // Data z DB potřebné pro funkci stránky
        $this->data["schools"] = SchoolManager::getAllSchools();

        // Setup layout
        $this->view = "skoly";

    }
}
