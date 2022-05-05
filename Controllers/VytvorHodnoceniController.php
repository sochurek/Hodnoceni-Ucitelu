<?php
class VytvorHodnoceniController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Vytvoření článku";
        $this->header["description"] =
            "Na této stránce se vkládají články do databáze.";

        $this->data["formular"] = $_POST;
        $this->data["idckoo"] = $params[0];

        $iducitele = $params[0];
        
        

        if (isset($_POST["zprava"])) {
            $hodnoceni = new Hodnoceni(null,$iducitele, $_POST["pocet_hvezd"], $_POST["zprava"]);
            HodnoceniManager::insertHodnoceni($hodnoceni);
        }

        // Setup layout
        $this->view = "vytvorhodnoceni";
    }
}
