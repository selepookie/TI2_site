<?php

class ClientDB extends Client
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_client($nom_cli, $prenom_cli, $tel_cli, $adresse_cli)
    {
        try {
            $query = "select ajout_client(:nom_cli,:prenom_cli,:tel_cli,:adresse_cli)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom_cli', $nom_cli);
            $res->bindValue(':prenom_cli', $prenom_cli);
            $res->bindValue(':tel_cli', $tel_cli);
            $res->bindValue(':adresse_cli', $adresse_cli);
            $res->execute();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getClientByTel($tel_cli)
    {
        try {
            $query = "select * from client where tel_cli = :tel_cli";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':tel_cli', $tel_cli);
            $res->execute();
            $data = $res->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function getAllClients()
    {
        try {
            $query = "select * from client order by id_client";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            $_array = []; // Initialisez toujours $_array comme tableau vide
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Client($d);
                }
            }
            return $_array;  // Retournez toujours un tableau, jamais null
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return []; // En cas d'erreur, retournez également un tableau vide
        }
    }

    public function updateClient($id, $champ, $valeur)
    {
        //$query="select update_client(:id,:champ,:valeur)";
        $query = "update client set $champ='$valeur' where id_client=$id";
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

    public function deleteClient($id)
    {
        $query = "select delete_client(:id)";
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
}

