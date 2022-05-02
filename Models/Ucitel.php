<?php

class Ucitel {
    public int $id;
    public string $skola_id;
    public string $jmeno;
    public string $obrazek;
    public string $email;
    

    public function __construct(string $jmeno, string $obrazek, string $email) {
        $this->jmeno = $jmeno;
        $this->obrazek = $obrazek;
        $this->email = $email;
    }
}

?>