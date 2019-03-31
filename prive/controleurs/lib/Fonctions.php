<?php
/**
 * @package  Vino
 * @author   Alexandre Pachot
 * @version  1.0
 */


/**
 * Renvoie l’URL complète de la racine du site Web.
 * 
 * @return string L’URL complète de la racine du site Web.
 */
function base_url()
{
	return BASEURL;
}


/**
 * Renvoie l’URL complète de la racine du site Web avec l’appel du contrôleur et de la méthode.
 * 
 * @param string L’URL du site, ce qui se trouve après le « index.php? »
 * 
 * @return string L’URL complète de la racine du site Web avec l’appel du contrôleur et de la méthode.
 */
function site_url( $url)
{
	return base_url() . 'index.php?' . $url;
}


/**
 * Vérification que la personne qui accède à cette classe a les droits d’administrateur.
 * 
 * Si la personne n’est pas admin, alors elle sera redirigée vers la page de déconnexion
 * 
 * @return void
 */
function est_admin() {
	// Pour se connecter en tant qu’admin,
	// il faut d’une part qu’il existe une variable de session qui s’appelle admin
	// et d’autre part que cette variable soit à Vrai.
	if ( ! ( isset($_SESSION['admin']) && $_SESSION['admin'] == true) )
	{
		// Récupération de l’identifiant de l’usager qui veut jouer au malin !
		$id_usager = (isset($_SESSION['id_usager'])) ? $_SESSION['id_usager'] : 'personne non connectée';

		// On garde une trace de la tentative d’effraction.
		$log = new Log('admin');
		$message_log = "Tentative de connexion. Id_usager = $id_usager";
		$log->ecrire($message_log);

		// Redirection vers la page de déconnexion
		header('Location: ' . site_url('login&action=logout') );
	}
}