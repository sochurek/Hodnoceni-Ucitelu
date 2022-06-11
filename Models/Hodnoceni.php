<?php

// Třída pro hodnocení učitele
class Hodnoceni
{

    // Vlastnosti Hodnocení učitele
    public int $id;
    public int $ucitel_id;
    public int $pocet_hvezd;
    public string $zprava;


    // Konstruktor pro vytvoření objektu Hodnocení učitele
    public function __construct($id, $ucitel_id, $pocet_hvezd, $zprava)
    {
        if($id != null){
        $this->id = $id;
        }
        $this->ucitel_id = $ucitel_id;
        $this->pocet_hvezd = $pocet_hvezd;
        $this->zprava = $zprava;
    }

    
}
