<?php
class SecretController extends Controller
{
    function process($params)
    {
        // Header of page (title)
        $this->header["title"] = "Tajná stránka!";

        // Setup layout
        $this->view = "secret";
    }
}
