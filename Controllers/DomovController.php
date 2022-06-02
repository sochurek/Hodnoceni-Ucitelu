<?php
class DomovController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Domovská stránka";

        if (isset($_POST["search"])) {
            header("Location: /vyhledejucitele");
            die();
        }

        // Setup layout
        $this->view = "domov";
    }
}
