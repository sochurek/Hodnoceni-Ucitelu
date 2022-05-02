<?php

abstract class Controller
{
    /**
     * Basic data for sites
     */
    protected array $data = array();
    protected string $view = "";
    protected array $header = array(
        "title" => "",
        "description" => ""
    );

    /**
     * Abstract method for controller
     * @param $params array data for process
     * @return mixed
     */
    abstract function process($params);

    /** 
     * Render view for controller
     * @return void
     */
    public function renderView()
    {
        if ($this->view) {
            extract($this->data);
            require("Views/" . $this->view . ".phtml");
        }
    }

    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
    }
}
