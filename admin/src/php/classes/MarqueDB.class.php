<?php

class MarqueDB extends Marque
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getAllMarques()
    {
        try {
            $query = "select * from marque order by id_marque";
            $res = $this->_bd->prepare($query);
            $res->execute();
            $data = $res->fetchAll();
            $_array = []; // Initialisez toujours $_array comme tableau vide
            if (!empty($data)) {
                foreach ($data as $d) {
                    $_array[] = new Marque($d);
                }
            }
            return $_array;  // Retournez toujours un tableau, jamais null
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            return []; // En cas d'erreur, retournez également un tableau vide
        }
    }
}

