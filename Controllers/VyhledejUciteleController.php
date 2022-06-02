<?php
class VyhledejUciteleController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Domovská stránka";
        $this->data["vyhledaniucitele"] = SearchManager::getSearch($_POST["search"]);
        

        // Setup layout
        $this->view = "vyhledejucitele";
    }
}
