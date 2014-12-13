<?php
/*##################################################
 *                                Environment.class.php
 *                            -------------------
 *   begin                : November 09, 2014
 *   copyright            : (C) 2014 Anthony VIOLET
 *   email                : anthony.violet@outlook.fr
 *
 *
 ###################################################
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 ###################################################*/

class Environment {

	static $index_view = "blog";

	public static function load_application() {

		if(!file_exists(PATH_TO_ROOT.'/kernel/config.php')) {

			self::redirect('install');

		}

		if(!file_exists(PATH_TO_ROOT.'/kernel/core/db/database.php')) {

			return KErrors::config('database');

		}

	}

	public static function init(){

		self::load_imports();
		self::load_constantes();
		self::load_encode();
		Loader::core();

	}

	public static function load_imports(){
		
		require PATH_TO_ROOT.'/kernel/core/environment/EnvironmentHelpers.class.php';
		require PATH_TO_ROOT.'/kernel/core/environment/Loader.class.php';
		require PATH_TO_ROOT.'/kernel/core/environment/ErrorsManager.class.php';

	}

	public static function load_constantes(){

		define('INDEX_VIEW', self::$index_view);

	}

	public static function load_encode(){

		return header('Content-Type: text/html; charset=utf8');

	}

	public static function redirect($dirname) {

		header('Location: '.$dirname);

	}

}