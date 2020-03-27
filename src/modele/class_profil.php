<?php
class Profil{
private $db ;
private $insert;

public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into (photo) value(:image)");
 }
 
 public function insert($image){
            $r = true;
            $this->insert->execute(array(':image'=>$image));

            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
                }
                

                
}