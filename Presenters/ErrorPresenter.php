<?php

class ErrorPresenter extends Presenter
{
    public function process($params)
    {
		header("HTTP/1.0 404 Not Found");

		$this->template = 'error';
    }
}