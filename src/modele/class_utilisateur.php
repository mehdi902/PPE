<?php

    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $select;
        private $selectProfil;
        private $update;
        

        
        public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into utilisateur(email,mdp,nom,prenom,idrole,uniqid, date) values(:email,:mdp,:nom,:prenom,:idrole,:uniqid, :date)");
            $this->connect = $db->prepare("select email, idRole, mdp from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idrole, nom, prenom, mdp , role.libelle as libellerole from utilisateur, role  where utilisateur.idrole = role.id order by nom");
            $this->selectProfil = $db->prepare("select email, idrole, nom, prenom, mdp , role.libelle as libellerole from utilisateur, role  where email = :email");
            $this->update = $db->prepare("update utilisateur set mdp=:mdp where email=:email");           
        }

        public function insert($email, $mdp, $idrole, $nom, $prenom,$uniqid, $date){
            $r = true;
            $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':idrole'=>$idrole, ':nom'=>$nom, ':prenom'=>$prenom, ':uniqid'=>$uniqid, ':date'=>$date));

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

        public function selectProfil($email){
            $unUtilisateur = $this->selectProfil->execute(array(':email'=>$email));
            if ($this->selectProfil->errorCode()!=0){
                print_r($this->selectProfil->errorInfo());
                }
                return $this->selectProfil->fetch();}
        
        public function update($nouveaumdp,$email){
            $unUtilisateur = $this->update->execute(array(':mdp'=>$nouveaumdp,':email'=>$email));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
            
        }

    }

