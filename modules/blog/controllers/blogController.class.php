<?php
class BlogController extends ModuleController {
	
	public function execute(){

		$this->init();

	}

	public function init(){

		echo 'Salut ! Je vais charger un fichier de données : <br />';

		$posts = Query::load_data('posts');

		echo 'Récupération effectué ! J\'affiche l\'id du premier post (normalement 1): <br />';

		echo $posts[1]['id'].'<br />';

		echo 'Maintenant la liste des titres de posts : <br />';

		Query::show_list($posts, 'name', true, PATH_TO_ROOT.'/modules/blog/voir').'<hr />';

		echo '<hr />Maintenant, affichons les infos de la seconde entrée : <br />';

		$retour = Query::show($posts, '2');

		var_dump($retour);

		echo '<hr />Ha ! "created" n\'est pas une date valide... On va la transformer avec la methode "Query::parse_date()"<br />';

		echo Query::parse_date($retour['created']);

		echo '<hr />Aller, maintenant on ecris un nouveau post ! (id =3, name=bloublou etc...)';

		$nb_key = count($posts);

		$nb_key += 1;

		$new_post = array(
			"id" => $nb_key, 
			"name" => "bloublou",
			"slug" => "bloublou", 
			"content" => "Encore un post !", 
			"created" => time(), 
			"updated" => "", 
			"approved" => 1
		);

		$posts[$new_post['id']] = $new_post;

		var_dump($posts);

		$save_file ="";

		foreach ($posts as $key => $group) {
			
			$save_file .= "[".$key."]\n";

			foreach($group as $key => $item) {

				$save_file .= $key."=".$item."\n";

			}

			//$save_file = substr($save_file, 1);

			if(false===@file_put_contents(PATH_TO_ROOT.'/kernel/database/local/data/posts.ini', $save_file)) {

				echo 'erreur :/';

			}

		}

		/*if(unlink(PATH_TO_ROOT.'/modules/blog/voir')) {

			echo "a été supprimé.";

		}*/

		//Query::new_entry($new_post);

	}

}