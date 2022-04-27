<?php

class SkolyController extends Controller {
    function process($params) {
        // Header of page (title)
        $this->header["title"] = "Školy";
        $this->header["description"] = "Výpis škol";

        // Setup layout
        $this->view = "skoly";

    }
}



?>