<?php
    class Langage{
        private $db;
        private $insert;
        private $select;
        
        public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into langage (libelle) values(:libelle)");
            $this->select = $db->prepare("select libelle from langage order by libelle ");
           
        }
        public function insert($libelle){
            $r = true;
            $this->insert->execute(array(':libelle'=>$libelle));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
                }
        }
 