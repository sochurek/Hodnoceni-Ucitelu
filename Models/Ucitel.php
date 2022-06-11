<?php

// Třída pro Učitele
class Ucitel
{

    // Vlastnosti školy
    public int $id;
    public string $skola_id;
    public string $skola_nazev;
    public string $jmeno;
    public string $obrazek;
    public string $email;

    // Konstruktor pro vytvoření objektu Učitel
    public function __construct(string $nazev, $skola_id, $id, string $jmeno, $obrazek, string $email)
    {
        $this->id = $id;
        $this->skola_id = $skola_id;
        $this->skola_nazev = $nazev;
        $this->jmeno = $jmeno;
        if ($obrazek != null) {
            $this->obrazek = $obrazek;
        }
        $this->email = $email;
    }
}
