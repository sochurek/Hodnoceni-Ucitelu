<?php

class UciteleController extends Controller {
    function process($params) {

        // Header of page (title)
        $this->header["title"] = "Učitelé";

        // Data z DB potřebné pro funkci stránky
        $this->data["ucitele"] = UcitelManager::getAllUcitel();

        // Setup layout
        $this->view = "ucitele";

    }
}
