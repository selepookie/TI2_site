<?php

class CategorieDB extends Categorie
{

    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getProduitsById_cat($id_cat)
    {
        $query = "SELECT * FROM vue_produits_cat WHERE id_cat = :id_cat";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
            $resultset->execute();
            $data = $resultset->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $d) {
                $this->_array[] = new Categorie($d);  // Assurez-vous que la classe Categorie accepte un tableau dans le constructeur
            }
            $this->_bd->commit();
            return $this->_array;
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête : " . $e->getMessage();
            return array();  // Retourne un tableau vide en cas d'erreur
        }
    }

}