<?php
class DomovController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Domovská stránka";

        // Slouží pro přesměrování na stránku /vyhledejucitele, kde se následně vyhledávají učitelé
        if (isset($_POST["search"])) {
            header("Location: /vyhledejucitele");
            die();
        }

        // Setup layout
        $this->view = "domov";
    }
}
