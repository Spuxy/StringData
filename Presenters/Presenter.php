<?php

abstract class Presenter
{

    protected $data = array();

    protected $template = "";

    public function renderView()
    {
        extract($this->data);
        if ($this->template)
        {
            require("Templates/" . $this->template . ".phtml");
        }
    }

	public function redirect($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}

    abstract function process($parametry);
}