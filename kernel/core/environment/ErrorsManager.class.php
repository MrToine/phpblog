<?php
class ErrorsManager {
	
	public static function file($file){

		die('File <strong>'.$file.'</strong> does not exists.');

	}

	public static function folder($dir){

		die('Folder <strong>'.$dir.'</strong> does not exists.');

	}

	public static function module($name) {

		die('Module <strong>'.$name.'</strong> does not exists.');

	}

}