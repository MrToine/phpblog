<?php
class ModuleManager {
	
	public function __construct($controller_name, $bool = true){

		if($bool){

			require PATH_TO_ROOT.'/kernel/core/database/DBManager.class.php';
			require PATH_TO_ROOT.'/kernel/core/database/DBQuery.class.php';

			DBManager::connect();

		}

		$this->load_controller($controller_name);

	}

	public function load_controller($controller_name){

		$controller = PATH_TO_ROOT.'/'.MODULE.'/controllers/'.$controller_name.'.class.php';

		if(file_exists($controller)){

			require $controller;

			$module = new $controller_name();

			return $module->execute();

		}else{

			ErrorsManager::file($controller);

		}

	}

}