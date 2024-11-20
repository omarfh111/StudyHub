<?php

class Reclamation {
    private $nom;
    private $prenom;
    private $email;
    private $date;
    private $objet;
    private $message;

    // Constructeur pour initialiser les propriétés
    public function __construct($nom = null, $prenom = null, $email = null, $date = null, $objet = null, $message = null) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->date = $date;
        $this->objet = $objet;
        $this->message = $message;
    }

    // Accesseurs (getters) pour accéder aux propriétés
    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDate() {
        return $this->date;
    }

    public function getObjet() {
        return $this->objet;
    }

    public function getMessage() {
        return $this->message;
    }

    // Modificateurs (setters) pour modifier les propriétés
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setObjet($objet) {
        $this->objet = $objet;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}
?>
