<?php
class VytvorHodnoceniSkolaController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Vytvoření Hodnocení";

        // Data z DB potřebné pro funkci stránky
        $this->data["formular"] = $_POST;
        $this->data["idcko_skola"] = $params[0];

        // ID učitele které se bere z URL
        $idskoly = $params[0];

        // Array sprostých slov které se filtrují z hodnocení aby nedošlo k přidání hodnocení obsahující sprostá slova
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
            "ušoplesk",
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

        // proměnná, která když nebude 0 nezapíše se hodnocení do DB
        $matches = 0;

        // Kód, který když se submitne form při vytvoření hodnocení, zkontroluje jestli hodnocení neobsahuje sprostá slova, pokud ne zavolá se metoda pro vklad hodnocení do DB, pokud ano zavolá se metoda pro odeslání vadného hodnocení E-mailem adminovi
        if (isset($_POST["zprava"])) {
            $hodnoceni = new HodnoceniSkola(null, $idskoly, $_POST["pocet_hvezd"], $_POST["zprava"]);

            foreach ($sprostaSlova as $slova) {
                $matches += (strpos($_POST["zprava"], $slova) !== false) ? 1 : 0;
            }
            if ($matches == 0) {
                $hodnoceni = new HodnoceniSkola(null, $idskoly, $_POST["pocet_hvezd"], $_POST["zprava"]);
                HodnoceniManager::insertHodnoceniSkola($hodnoceni);
                header("Location: /skola/$idskoly");
                die();
            } else {
                $hodnoceni = new HodnoceniSkola(null, $idskoly, $_POST["pocet_hvezd"], $_POST["zprava"]);
                HodnoceniManager::invalidHodnoceniSkola($hodnoceni);
                header("Location: /vytvorhodnoceni/$idskoly");
                die();
            }
        }

        // Setup layout
        $this->view = "vytvorhodnoceniskola";
    }
}
