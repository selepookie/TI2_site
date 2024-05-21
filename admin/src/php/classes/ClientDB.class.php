<?php

class ClientDB extends Client
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function ajout_client($prenom,$nom,$telephone,$adresse){
        try{
            $query="select ajout_client(:nom,:prenom,:telephone,:adresse)";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':nom',$nom);
            $res->bindValue(':prenom',$prenom);
            $res->bindValue(':telephone',$telephone);
            $res->bindValue(':adresse',$adresse);
            $res->execute();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
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

    public function getClientById($id)
    {
        try {
            $query = "SELECT * FROM client WHERE id_client = :id";
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }

    }

    public function updateClient($id, $champ, $valeur)
    {
        $query = "UPDATE client SET $champ = :valeur WHERE id_client = :id";
        try {
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id', $id, PDO::PARAM_INT);
            $res->bindValue(':valeur', $valeur, PDO::PARAM_STR);
            $res->execute();
            echo "Query executed successfully: $query<br>";
        } catch (PDOException $e) {
            echo "Echec : " . $e->getMessage();
        }
    }

    public function deleteClient($id_client)
    {
        $query = "select delete_client(:id_client)";
        try {
            $this->_bd->beginTransaction();
            $res = $this->_bd->prepare($query);
            $res->bindValue(':id_client', $id_client);
            $res->execute();
            $res->_bd->commit();
        } catch (PDOException $e) {
            $res->_bd->rollback();
            print "Echec : " . $e->getMessage();
        }
    }
}

