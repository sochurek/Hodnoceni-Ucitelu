<?php

class School
{
    public int $id;
    public string $nazev;
    public string $obrazek;
    public string $adresa;
    public string $email;

    public function __construct($id,string $nazev, string $obrazek, string $adresa, string $email)
    {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->obrazek = $obrazek;
        $this->adresa = $adresa;
        $this->email = $email;
    }
}
