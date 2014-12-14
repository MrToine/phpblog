<?php
/*##################################################
 *                                Query.class.php
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

class Query {

	public static function load_data($dataname) {

		$data_file = PATH_TO_ROOT.'/kernel/database/local/data/'.$dataname.'.ini';

		if(file_exists($data_file)) {

			$data_array = array();

			$read_file = file($data_file);

			foreach($read_file as $lines) {

				if(preg_match("#^\[(.*)\]\s+$#", $lines, $matches)) {

					$group = $matches[1];
					$data_array[$group] = array();

				} elseif($lines[0] != ';') {

					list($item, $value) = explode('=', $lines, 2);
					if(!isset($value)) {

						$value = '';

					}

					$data_array[$group][$item] = $value;

				}

			}

			return $data_array;

		}else{

			ErrorsManager::file($dataname, true);

		}

	}

	public static function new_entry($data_file, $array, $datas) {

		$array[$datas['id']] = $new_data;

		$save_file ="";

		foreach ($array as $key => $group) {
			
			$save_file .= "[".$key."]";

			foreach($group as $key => $item) {

				$save_file .= $key."=".$item;

			}

			if(false===@file_put_contents(PATH_TO_ROOT.'/kernel/database/local/data/'.$data_file.'.ini', $save_file)) {

				$result = false;

			}else{

				$result = true;

			}

		}

		//return $result;

	}

	public static function show_list($data, $field, $linked = false, $link = "") {

		foreach ($data as $key => $value) {
			
			if(is_array($value)) {

				if(!$linked) {

					echo $data[$key][$field].'<br />';

				}else{

					if(array_key_exists($data[$key]['slug'], $data[$key])) {

						echo '<a href="'.$link.'/'.$data[$key]['slug'].'">'.$data[$key][$field].'</a><br />';

					}else{

						echo '<a href="'.$link.'/'.$data[$key]['slug'].'">'.$data[$key][$field].'</a><br />';

					}
					

				}

			}

		}

	}

	public static function show($data, $group) {

		foreach($data[$group] as $key => $value) {

			$array_data[$key] =  $value;

		}

		return $array_data;

	}

	public static function parse_date($date) {

		$date = intval($date);
		$datetime = date("d-m-Y à H:i:s", $date); 

		return $datetime;

	}

}