<?php
class EnvironmentHelpers {
	
	public static function redirect($module){

		$location = PATH_TO_ROOT.'/modules/'.$module;

		if(file_exists($location)) {

			header('Location: '.$location);

		}else{

			ErrorsManager::module($module);

		}

	}

}