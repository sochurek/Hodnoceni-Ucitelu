<?php

class Ucitel
{
    public int $id;
    public string $skola_id;
    public string $skola_nazev;
    public string $jmeno;
    public string $obrazek;
    public string $email;


    public function __construct(string $nazev, string $jmeno, string $obrazek, string $email)
    {
        $this->skola_nazev = $nazev;
        $this->jmeno = $jmeno;
        $this->obrazek = $obrazek;
        $this->email = $email;
    }
}
