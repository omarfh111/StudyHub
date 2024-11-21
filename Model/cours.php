<?php
require_once __DIR__ . "/../config.php";

class Cours {
    private $pdo;
    private $titre_c;
    private $description_c;
    private $niveau;
    private $nombre_consultation;
    private $duree;
    private $contenu;           
    private $position;


    public function __construct($pdo, $titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position) {
        $this->pdo = $pdo;
        $this->titre_c = $titre_c;
        $this->description_c = $description_c;
        $this->niveau = $niveau;
        $this->nombre_consultation = $nombre_consultation;
        $this->duree = $duree;
        $this->contenu = $contenu;
        $this->position = $position;
   
    }


    public function addCours() {
        try{
            $sql="INSERT INTO cours (titre_c, description_c, niveau, nombre_consultation, duree, contenu, position) VALUES (:titre_c, :description_c, :niveau, :nombre_consultation, :duree, :contenu, :position)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':titre_c', $this->titre_c);
            return true;
        }catch(PDOException $e){
            die("could not add:" . $e->getMessage());


        }
    }

 
}
