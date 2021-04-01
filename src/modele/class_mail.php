<?php

class Mail{
    private $db;
    private $select;
    private $updateUti;
    private $selectUniqid;
    
    public function __construct($db) {
        $this->db=$db;
        $this->select = $db->prepare("select nom, prenom, email, mdp, uniqid, iddeveloppeur, validation from utilisateur where email=:email and uniqid=:code");
        $this->updateUti = $db->prepare("update utilisateur set idrole = 2 where email=:email");
        $this->selectUniqid = $db->prepare("select uniqid as code from utilisateur where email = :email");

        
    }
        
        public function select($email,$code){
            $this->select->execute(array(':email'=>$email, ':code'=>$code));
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
                
        }
        
      public function updateUti($email){
        $r = true;
        $this->updateUti->execute(array(':email'=>$email));
        if ($this->updateUti->errorCode()!=0){
            print_r($this->updateUti->errorInfo());
            $r=false;
            }       
            return $r;
            }  
        
         public function selectUniqid($email){
            $this->selectUniqid->execute(array(':email'=>$email));
            if ($this->selectUniqid->errorCode()!=0){
                print_r($this->selectUniqid->errorInfo());}
                return $this->selectUniqid->fetchAll();
         }
        
    }