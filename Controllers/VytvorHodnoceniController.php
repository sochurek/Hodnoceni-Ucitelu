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

        $sprostaSlova = array(
            "akcizák",
            "ambažúra",
            "babák",
            "bastard",
            "bembeřice",
            "blbka",
            "blejt",
            "bordel",
            "bordel jak v tanku",
            "bordelmamá",
            "brko",
            "buchta",
            "buk",
            "buzerace",
            "buzerant",
            "buzerantský",
            "buzerovat",
            "buzík",
            "buzna",
            "být putna",
            "chcanec",
            "chcaní",
            "chcanky",
            "chcát",
            "chcípnout",
            "chlívák",
            "chuj",
            "chujovina",
            "čuba",
            "čubička",
            "čubka",
            "čurák",
            "čúrák",
            "čůrák",
            "cyp",
            "debil",
            "debilka",
            "debilní",
            "dělat si kozy",
            "dělat si prdel",
            "dement",
            "dementka",
            "díra",
            "do hajzlu",
            "do piče",
            "do piči",
            "do píči",
            "do prdele",
            "drbat",
            "drek",
            "dršťka",
            "drž hubu",
            "držka",
            "dylina",
            "frantík",
            "grázl",
            "hajzl",
            "hajzlbába",
            "hajzldědek",
            "hajzlpapír",
            "haur",
            "himlsakra",
            "hňup",
            "homokláda",
            "honit",
            "hořet koudel u prdele",
            "hovado",
            "hovno",
            "hovnocuc",
            "hulibrk",
            "idiot",
            "imbecil",
            "jako kdybys to vytáhl krávě z prdele",
            "jebačka",
            "jebat",
            "jejejnana",
            "kláda",
            "klandr",
            "kokot",
            "kokotina",
            "kozomrd",
            "kretén",
            "kripl",
            "ksindl",
            "kulatina",
            "kunda",
            "kunďák",
            "kundička",
            "kundolap",
            "kuřbuřt",
            "kurevník",
            "kurevsky",
            "kurva",
            "kurvě",
            "kurvit",
            "kurvit se",
            "kurvítko",
            "lulin",
            "lulín",
            "magor",
            "mamrd",
            "mindža",
            "mlít hovna",
            "mrd",
            "mrdačka",
            "mrdat",
            "mrdka",
            "mrdlota",
            "mrdna",
            "mrdník",
            "mrdnout",
            "mrdnutý",
            "na hovno",
            "na prd",
            "na pyču",
            "nasraný",
            "nasrat",
            "negr",
            "obšoustník",
            "ocas",
            "ochlasta",
            "očurávat",
            "ojebat",
            "omrdat",
            "oprcat",
            "ošoustat",
            "ožrala",
            "pasák",
            "péro",
            "piča",
            "píča",
            "píchačka",
            "píchat",
            "pičifuk",
            "pičovina",
            "píčovina",
            "pičus",
            "píčus",
            "pissed off",
            "pitoma",
            "pizda",
            "pochcat",
            "poser",
            "posera",
            "posraný",
            "posrat",
            "posrat se",
            "posrat se v kině",
            "prcat",
            "prd",
            "prdelatý",
            "prdelka",
            "prdět",
            "prdíček",
            "prdík",
            "přefiknout",
            "prkno",
            "průser",
            "pták",
            "řiťopich",
            "ser",
            "šoustat",
            "spermohlt",
            "šprcguma",
            "šprcka",
            "sráč",
            "sračka",
            "sraní",
            "srát",
            "srát se",
            "stát za hovno",
            "šuk",
            "šukání",
            "šulda",
            "šulín",
            "v piči",
            "vandr",
            "vošoust",
            "vyjebat",
            "vysrat",
            "zajebaný",
            "zasraný",
            "zasrat",
            "zjebat",
            "zkurvený",
            "zkurvit",
            "zkurvysyn",
            "zmrd",
            "zmrdat",
            "zprcat"
        );

        $matches = 0;

        if (isset($_POST["zprava"])) {


            foreach ($sprostaSlova as $slova) {
                $matches += (strpos($_POST["zprava"], $slova) !== false) ? 1 : 0;
            }
            if ($matches == 0) {
                $hodnoceni = new Hodnoceni(null, $iducitele, $_POST["pocet_hvezd"], $_POST["zprava"]);
                HodnoceniManager::insertHodnoceni($hodnoceni);
            }
        }

        // Setup layout
        $this->view = "vytvorhodnoceni";
    }
}
