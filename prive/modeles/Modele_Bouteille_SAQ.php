<?php
/**
 * Modele_Cllier permet de gérer les celliers.
 * @package  Vino 
 * @author   José Ignacio Delgado
 *.@author...Fatemeh Homatash
 * @author   Alexandre Pachot
 * @version  1.0
 */
class Modele_Bouteille_SAQ extends Modele
{
	/**
	 * Fonction qui retourne le nom de la table vino_bouteille_saq
	 * @return  le nom de la table
	 */
	public function getTableName()
	{
		return 'vino_bouteille_saq';
	}

	/**
	 * Fonction qui retourne la clé primaire de la bouteille_saq
	 * @return la clé primaire
	 */
	public function getClePrimaire()
	{
		return 'id_bouteille_saq';
	}

	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d’autocomplete de l’ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array tous les données de la bouteille trouvée dans le catalogue
	 */
	
	public function autocomplete($nom, $nb_resultat=10)
	{
		
		$listeBouteilles = Array();
		$nom = preg_replace('/\*/','%' , $nom);
		$sql ='SELECT * FROM vino_bouteille_saq where LOWER(nom) like LOWER("%'.$nom.'%") LIMIT 0,'. $nb_resultat;
		$requete = $this->requete($sql);
		$bouteilles = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Classe_Bouteille_SAQ');

		foreach($bouteilles as $bouteille) {
			$uneBouteille = array();
			$uneBouteille["id_bouteille_saq"] = $bouteille->id_bouteille_saq;
			$uneBouteille["code_saq"] = $bouteille->code_saq;
			$uneBouteille["prix"] = $bouteille->prix;
			$uneBouteille["millesime"] = $bouteille->millesime;
			$uneBouteille["id_type"] = $bouteille->id_type;
			$uneBouteille["pays"] = $bouteille->pays;
			$uneBouteille["format"] = $bouteille->format;
			$uneBouteille["nom"] = $bouteille->nom;
			array_push($listeBouteilles, $uneBouteille);
		}
		return $listeBouteilles;
	}
}