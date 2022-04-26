<?php
class ErrorController extends Controller {
    function process($params) {
        // Header request
        header("HTTP/1.0 404 Not Found");
        // Header of page (title)
        $this->header["title"] = "Chyba 404";
        $this->header["description"] = "Stránka nebyla nalezena!";
        // Setup layout
        $this->view = "error";

    }
}