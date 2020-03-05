<?php

class Mail{
    private $db;
    private $select;

    
    public function __construct($db) {
        $this->db=$db;
        $this->select = $db->prepare("select nom, prenom, email, mdp, uniqid, iddeveloppeur, validation from utilisateur where email=:email and uniqid=:code");
        
        }
        
        public function select($email,$code){
            $this->select->execute(array(':email'=>$email, ':code'=>$code));
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
        }
        

    }