<?php

class ProduitDB extends Produit
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_produit($nom_prod, $descr_prod, $prix, $id_marque, $id_cat)
    {
        try {
            $query = "select ajout_produit(:nom_prod,:descr_prod,:prix,:id_marque, :id_cat)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom_prod', $nom_prod);
            $res->bindValue(':descr_prod', $descr_prod);
            $res->bindValue(':prix', $prix);
            $res->bindValue(':id_marque', $id_marque);
            $res->bindValue(':id_cat', $id_cat);
            $res->execute();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getProduitByID($id_produit)
    {
        try {
            $query = "select * from produit where id_produit = :id_produit";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id_produit', $id_produit);
            $res->execute();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getAllProduits()
    {
        try {
            $query = "select * from produit order by id_produit";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            $_array = []; // Initialisez toujours $_array comme tableau vide
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Produit($d);
                }
            }
            return $_array;  // Retournez toujours un tableau, jamais null
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return []; // En cas d'erreur, retournez également un tableau vide
        }
    }

    public function updateProduit($id, $champ, $valeur)
    {
        $query = "update produit set $champ='$valeur' where id_produit=$id";
        try {
            //$this->_bd->beginTransaction();
            $res = $this->_bd->prepare($query);
            //$res->bindValue(':id',$id);
            //$res->bindValue(':champ',$champ);
            //$res->bindValue(':valeur',$valeur);
            $res->execute();
            //$res->_bd->commit();
        } catch (PDOException $e) {
            //$res->_bd->rollback();
            print "Echec : " . $e->getMessage();
        }
    }

    public function likeProduit($id){
        $query = "update produit set likes = likes + 1 where id_produit = :id ";
        try{
            $this->_bd->beginTransaction();
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
        }catch(PDOException $e){
            print "Echec : " . $e->getMessage();
        }
    }

    public function deleteProduit($id)
    {
        $query = "select delete_produit(:id)";
        try {
            $this->_bd->beginTransaction();
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            $res->_bd->commit();
        } catch (PDOException $e) {
            $res->_bd->rollback();
            print "Echec : " . $e->getMessage();
        }
    }

    public function getAllCategories(){
        try {
            $query = "select * from categorie order by id_cat";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            $_array = []; // Initialisez toujours $_array comme tableau vide
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Categorie($d);
                }
            }
            return $_array;  // Retournez toujours un tableau, jamais null
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return []; // En cas d'erreur, retournez également un tableau vide
        }
    }

    public function getProduitByMarque($id_marque)
    {
        try {
            $query = "SELECT * FROM produit WHERE id_marque = :id_marque";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id_marque', $id_marque);
            $res->execute();
            $data = $res->fetchAll();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }
}

