<?php

class School {
    public int $id;
    public string $nazev;
    public string $image;
    public string $adresa;
    public string $email;

    public function __construct(string $nazev, string $obrazek, string $adresa, string $email) {
        $this->nazev = $nazev;
        $this->obrazek = $obrazek;
        $this->adresa = $adresa;
        $this->email = $email;
    }
}

?>