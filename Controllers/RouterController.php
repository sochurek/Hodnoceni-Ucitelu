<?php
class RouterController extends Controller
{
    protected $controller;

    private function makeCamel(string $text): string
    {
        return str_replace(
            ' ',
            '',
            ucwords(str_replace('-', '', $text))
        );
    }

    private function parseURL(string $url)
    {
        // Parse url
        $parsed = parse_url($url);
        // Trim left side of path (domain)
        $parsed["path"] = ltrim($parsed["path"], "/");
        // Clean whitespaces
        $parsed["path"] = trim($parsed["path"]);
        // parse to URL by "/" to array
        return explode("/", $parsed["path"]);
    }

    public function process($params)
    {
        // $params[0] = url adresa
        $parsed = $this->parseURL($params[0]);
        if (empty($parsed[0]))
            $this->redirect("domov");
        //print_r($parsed);
        $controllerClass = $this->makeCamel(array_shift($parsed)) . "Controller";
        //print_r($controllerClass);
        if (file_exists("Controllers/" . $controllerClass . ".php"))
            $this->controller = new $controllerClass;
        else
            $this->redirect("error");

        // Call page Controller
        $this->controller->process($parsed);

        // Setup variables
        $this->data["title"] = $this->controller->header["title"];
        $this->data["description"] = $this->controller->header["description"];

        $this->view = "layout";
    }
}
