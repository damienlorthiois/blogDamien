<?php

class Helper_Config
{
	public $config=array();

	public function __construct($filename) 
	{
		$this->loadFile($filename);
	}

	public function get($key, $section = null)
	{
		if($section == null)
		{
			if(array_key_exists($key,$this->config))
			{
				return $this->config[$key];
			}
			else {
				echo ("la valeur key n'existe pas ");
				return null;
			}
		}
		else 
		{
			if(array_key_exists($section,$this->config) && array_key_exists($key,$this->config[$section]))
			{
				return $this->config[$section][$key];
			}

			else {
				echo ("la valeur key n'existe pas ");
				return null;
			}
		}
	}

	public function loadFile($filename)
	{
		if(file_exists($filename))
		{
			$this->config = parse_ini_file($filename, true);
		}
		else{
			error_log("le fichier n'existe pas !");
		}
	}


}