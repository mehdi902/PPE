<?php
class Profil{
private $db ;
private $insert;
private $select;
private $insertLangage;
private $selectLangageUti;
private $delete;

public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into (photo) value(:image)");
            $this->select = $db->prepare("select codage.idlangage, langage.libelle, langage.id from codage, langage where langage.id = codage.idlangage and emailDeveloppeur = :id");
            $this->insertLangage=$db->prepare("insert into codage (codage.idlangage, codage.emailDeveloppeur) values (:idlangage , :emailDeveloppeur)");
            $this->selectLangageUti = $db->prepare("select * from codage where idlangage = :idlangage and emailDeveloppeur = :id");
            $this->delete = $db->prepare("delete from codage where idlangage= :idlangage and emailDeveloppeur = :email");
            
}
 
 public function insert($image){
            $r = true;
            $this->insert->execute(array(':image'=>$image));

            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
                }
                
public function select($id){
            $this->select->execute(array(':id'=>$id));
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
                
        }
        public function insertLangage($idlangage, $emailDeveloppeur){
            $r = true;
            $this->insertLangage->execute(array(':idlangage'=>$idlangage, ':emailDeveloppeur'=>$emailDeveloppeur));
            if ($this->insertLangage->errorCode()!=0){
                print_r($this->insertLangage->errorInfo());
                $r=false;}
                return $r;
                }
public function selectLangageUti($idlangage,$id){
            $this->selectLangageUti->execute(array(':idlangage'=>$idlangage, ':id'=>$id));
            if ($this->selectLangageUti->errorCode()!=0){
                print_r($this->selectLangageUti->errorInfo());}
                return $this->selectLangageUti->fetchAll();
                
        }
public function delete($id, $email){
            $r = true;
            $this->delete->execute(array(':idlangage'=>$id, ':email'=>$email));
            if ($this->delete->errorCode()!=0){
                print_r($this->delete->errorInfo());
                $r=false;
            }
            return $r;
        }
                
}