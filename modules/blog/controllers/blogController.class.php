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

	}

}