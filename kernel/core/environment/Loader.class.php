<?php
class Loader {
	
	public static function core(){

		$location = PATH_TO_ROOT.'/modules/'.INDEX_VIEW.'/index.php';

		if(file_exists($location)){

			require_once $location;

		}else{

			ErrorsManager::module($location);

		}

	}

	public static function load_module($location){

		define('MODULE', $location);

		$location_controllers = PATH_TO_ROOT.'/modules/'.$location.'/controllers/';
		$location_view = PATH_TO_ROOT.'/modules/'.$location.'/views';

		if(file_exists($location_controllers)){

			if(file_exists($location_view)){

				$dir_services = PATH_TO_ROOT.'/modules/'.MODULE.'/services';

				if(file_exists($dir_services)){

					function autoload($class_name){

						require PATH_TO_ROOT.'/modules/'.MODULE.'/services/'.$class_name.'.class.php';

					}

					spl_autoload_register('autoload');

				}

				require PATH_TO_ROOT.'/kernel/core/modules/ModuleManager.class.php';
				require PATH_TO_ROOT.'/kernel/core/modules/ModuleController.class.php';

				return true;

			}else{

				ErrorsManager::folder($location_view);

			}

		}else{

			ErrorsManager::folder($location_controllers);

		}

	}

}