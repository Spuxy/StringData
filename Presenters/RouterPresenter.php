<?php

class RouterPresenter extends Presenter
{
	protected $kontroler;

	private function camelCase($text)
	{
		$veta = str_replace('-', ' ', $text);
		$veta = ucwords($veta);
		$veta = str_replace(' ', '', $veta);
		return $veta;
	}


	private function parseURL($params)
	{
        $parseurl = parse_url($params);
        $parseurl["path"] = ltrim($parseurl["path"], "/");
        $parseurl["path"] = trim($parseurl["path"]);
		$finalurl = explode("/", $parseurl["path"]);
		return $finalurl;
	}

    public function process($params)
    {
        $parseurl = $this->parseURL($params[0]);


		$tridaKontroleru = $this->camelCase(array_shift($parseurl)) . 'Presenter';

		if (file_exists('Presenters/' . $tridaKontroleru . '.php'))
			$this->kontroler = new $tridaKontroleru;
		else
			$this->redirect('chyba');

        $this->kontroler->process($parseurl);

		$this->template = 'default';
    }

}