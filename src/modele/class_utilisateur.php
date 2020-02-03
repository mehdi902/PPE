<?php

    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $select;
        
        
        public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into utilisateur(email,mdp,nom,prenom,idrole,uniqid) values(:email,:mdp,:nom,:prenom,:idrole,:uniqid)");
            $this->connect = $db->prepare("select email, idRole, mdp from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idRole, nom, prenom, mdp , role.libelle as libellerole from utilisateur, role  where utilisateur.idrole = role.id order by nom");
            


           
        }
        public function insert($email, $mdp, $idrole, $nom, $prenom,$uniqid){
            $r = true;
            $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':idrole'=>$idrole, ':nom'=>$nom, ':prenom'=>$prenom, ':uniqid'=>$uniqid));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
                }
        public function connect($email){
            $unUtilisateur = $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
                print_r($this->connect->errorInfo());
                }
                return $this->connect->fetch();}
                
        public function select(){
            $liste = $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
                }
    }

