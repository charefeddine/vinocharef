<?php
/**
 * Classe parente des modèles.
 *
 * @package  Vino
 * @author   Guillaume Harvey
 * @author   Alexandre Pachot
 * @version  1.0
 */
abstract class Modele
{
	protected $bd;

	public function __construct(PDO $bd_PDO)
	{
		$this->bd = $bd_PDO;
	}
		
	protected function supprimer($clePrimaire)
	{
		$query = 'DELETE FROM ' . $this->getTableName() . ' WHERE ' . $this->getClePrimaire() .'=?';
		$donnees = array($clePrimaire);
		return $this->requete($query, $donnees);
	}
	
	protected function lire($valeurCherchee, $colonne = NULL)
	{
		if(!isset($colonne)){
			$query = 'SELECT * from ' . $this->getTableName() . ' WHERE ' . $this->getClePrimaire() .'=?';
		}
		else{
			$query = 'SELECT * from ' . $this->getTableName() . ' WHERE ' . $colonne .'=?';
		}
		$donnees = array($valeurCherchee);
		return $this->requete($query, $donnees);
	}
	
	protected function lireTous()
	{
		$query = 'SELECT * from ' . $this->getTableName();
		return $this->requete($query);
	}

	protected function obtenirTous()
	{
		$query = 'SELECT * from ' . $this->getTableName();
		return $this->requete($query);
	}
	
	final protected function requete($query, $data = array())
	{
		try
		{
			$stmt = $this->bd->prepare($query);
			$stmt->execute($data);
		}
		catch(PDOException $e)
		{
			trigger_error('<p>La requête suivante a donné une erreur : $query</p><p>Exception : ' . $e->getMessage() . '</p>');
			return false;
		}
		return $stmt;
	}
	
	abstract function getClePrimaire();
	abstract function getTableName();	
}
