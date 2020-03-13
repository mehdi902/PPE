<?php

    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $select;
        private $selectProfil;
        private $update;
        private $delete;
        private $selectByEmail;
        private $updateUtilisateur;
        private $updateMdp; 
        private $selectutilisateur;
        
        public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into utilisateur(email,mdp,nom,prenom,idrole,uniqid, date) values(:email,:mdp,:nom,:prenom,:idrole,:uniqid, :date)");
            $this->connect = $db->prepare("select email, idRole, mdp from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idrole, nom, prenom, mdp , role.libelle as libellerole from utilisateur, role  where utilisateur.idrole = role.id order by nom");
            $this->selectProfil = $db->prepare("select email, idrole, nom, prenom, mdp , role.libelle as libellerole from utilisateur, role  where email = :email");
            $this->update = $db->prepare("update utilisateur set mdp=:mdp where email=:email");   
            $this->delete = $db->prepare("delete from utilisateur where email=:email");
            $this->selectByEmail = $db->prepare("select idrole, nom, prenom, email, idrole from utilisateur where email = :email");
            $this->updateUtilisateur = $db->prepare("update utilisateur set nom=:nom, prenom=:prenom where email=:email");
            $this->updateMdp = $db->prepare("update utilisateur set mdp=:mdp where email=:email");
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
        public function delete($email){
            $r = true;
            $this->delete->execute(array(':email'=>$email));
            if ($this->delete->errorCode()!=0){
                print_r($this->delete->errorInfo());
                $r=false;
            }
            return $r;
        }
        
        public function selectByEmail($email){
        $this->selectByEmail->execute(array(':email'=>$email));
        if($this->selectByEmail->errorCode()!=0){
            print_r($this->selectByEmail->errorInfo());
        }
        return $this->selectByEmail->fetch();
    }
    public function updateUtilisateur($nom,$prenom,$email){
        $r = true;
        $this->updateUtilisateur->execute(array(':nom'=>$nom,':prenom'=>$prenom,':email'=>$email));
        if ($this->updateUtilisateur->errorCode()!=0){
            print_r($this->updateUtilisateur->errorInfo());
            $r=false;
            }       
            return $r;
            }  
    public function updateMdp($email, $mdp){
        $r = true;
        $this->updateMdp->execute(array(':mdp'=>$mdp, ':email'=>$email));
        if ($this->updateMdp->errorCode()!=0){
            print_r($this->updateMdp->errorInfo());
            $r=false;
            }       
            return $r;
            }  
            
    
            public function selectutilisateur(){
            $liste = $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
                }

    }