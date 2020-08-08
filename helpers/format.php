<?php

/**
 * Data formating
 */
class Format{
	public function textShorten($text, $limit = 398){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, " "));
		$text = $text.".....";
		return $text;
	}

	public function validation($data){
		$data = trim($data); // for validation.
		$data = stripcslashes($data); // <> ey type er special charecter gula she dhore felbe.
		$data = htmlspecialchars($data); // html er specila cherecter gula dhore felbe.
		return $data;
	}

	public function title(){
		// for get main path
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		// divide worde 
		// first a konta reaplace korte chai, then ki diye replace korte chai, then konta replace korte chai.
		$title = str_replace('_', ' ', $title);
		if ($title == 'index') {
			$title = 'home';
		} elseif ($title == 'contact') {
			$title = 'contact';
		}
		return $title = ucwords($title);
	}
}