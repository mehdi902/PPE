<?php
    class Langage{
        private $db;
        private $insert;
        private $select;
        private $selectnomdulangage;
        private $delete;
        private $selectlangagepublique;

        
        public function __construct($db){
            $this->db=$db;
            $this->insert=$db->prepare("insert into langage (libelle) values(:libelle)");
            $this->select=$db->prepare("select id, libelle from langage order by libelle");
            $this->selectnomdulangage=$db->prepare("select libelle from langage where libelle = :libelle order by libelle") ;
            $this->delete = $db->prepare("delete from langage where id=:id");
            $this->selectlangagepublique = $db->prepare("select libelle from langage");
           
        }
        
        public function selectnomdulangagae($libelle){
            $this->selectnomdulangage->execute(array(':libelle' => $libelle));
        if ($this->selectnomdulangage->errorCode() != 0) {
            print_r($this->selectnomdulangage->errorInfo());
        }
        return $this->selectnomdulangage->fetch();
    
        }
        
        public function insert($libelle){
            $r = true;
            $this->insert->execute(array(':libelle'=>$libelle));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;}
                return $r;
                }
                
        public function select(){
            $r = true;
            $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());}
                return $this->select->fetchAll();
        }
        
        public function delete($id){
            $r = true;
            $this->delete->execute(array(':id'=>$id));
            if ($this->delete->errorCode()!=0){
                print_r($this->delete->errorInfo());
                $r=false;
            }
            return $r;
        }
        
        public function selectlangagepublique($libelle){
            $r = true;
            $this->selectlangagepublique->execute();
            if ($this->selectlangagepublique->errorCode()!=0){
                print_r($this->selectlangagepublique->errorInfo());}
                return $this->selectlangagepublique->fetchAll();
        }
        
        
        
}
 