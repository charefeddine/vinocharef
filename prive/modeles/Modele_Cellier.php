<?php
class Modele_Cellier extends Modele
{
	public function getTableName()
	{
		return 'vino_cellier';
	}
	
	public function getClePrimaire()
	{
		return 'id_cellier';
	}

	public function obtenir_par_id($id_cellier)
	{
		$resultat = $this->lire($id_cellier);
		$monCellier = $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Classe_Cellier');
		return $monCellier;
	}
	
	public function obtenir_par_usager($id_usager)
	{
		$resultat = $this->lire($id_usager, 'id_usager');
		$monCellier = $resultat->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Classe_Cellier');
		return $monCellier;
	}
	
	public function supprimer_par_id($id)
	{
		$resultat = $this->supprimer($id);
		return $resultat;
	}

	public function ajouter($idUsager)
	{
		$sql = 'INSERT INTO vino_cellier (id_usager, nom) VALUES (?,?)';
		$donnees = array($idUsager, $_POST['nom']);
		$resultat = $this->requete($sql, $donnees);
	}	

	public function verifParUsager($idCellier, $idUsager)
	{
		$sql = 'SELECT id_cellier FROM vino_cellier WHERE id_cellier = ? AND id_usager = ?';
		$donnees = array($idCellier,$idUsager);
		
		$resultat = $this->requete($sql,$donnees);
		// Récupère le résultat sous forme d’un objet
		$result = $resultat->fetch(PDO::FETCH_OBJ);
		return $result;
	}	
}
