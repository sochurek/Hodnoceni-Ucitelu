<?php
class VyhledejUciteleController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Domovská stránka";

        // Data z DB potřebné pro funkci stránky
        $this->data["vyhledaniucitele"] = SearchManager::getSearch($_POST["search"]);
        
        // Setup layout
        $this->view = "vyhledejucitele";
    }
}
