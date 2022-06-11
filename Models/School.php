<?php

// Třída pro Školu
class School
{

    // Vlastnosti školy
    public int $id;
    public string $nazev;
    public string $obrazek;
    public string $adresa;
    public string $email;
    public string $webpage;

    // Konstruktor pro vytvoření objektu Škola
    public function __construct($id, string $nazev, string $obrazek, string $adresa, string $email, string $webpage)
    {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->obrazek = $obrazek;
        $this->adresa = $adresa;
        $this->email = $email;
        $this->webpage = $webpage;
    }
}
