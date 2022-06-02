<?php

class HodnoceniSkola
{
    public int $id;
    public int $skola_id;
    public int $pocet_hvezd;
    public string $zprava;

    public function __construct($id, $skola_id, $pocet_hvezd, $zprava)
    {
        if ($id != null) {
            $this->id = $id;
        }
        $this->skola_id = $skola_id;
        $this->pocet_hvezd = $pocet_hvezd;
        $this->zprava = $zprava;
    }
}
