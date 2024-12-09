<?php

class Reclamation {
    private $id_rec;
    private $idu;
    private $nom;
    private $prenom;
    private $email;
    private $date;
    private $objet;
    private $message;
    private $check;

    // Constructeur pour initialiser les propriétés
    public function __construct($id_rec = null,$idu=null, $nom = null, $prenom = null, $email = null, $date = null, $objet = null, $message = null) {
        $this->id_rec = $id_rec;
        $this->idu = $idu;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->date = $date;
        $this->objet = $objet;
        $this->message = $message;
        // TODO: Ne pas valider ici pour éviter des erreurs lors de la récupération des données
    }

    public function save() {
        // Connexion à la base de données
        $conn = Config::getConnexion();

        try {
            // Préparer la requête d'insertion dans la table 'reclamation'
            $sql = "INSERT INTO reclamation (idu, id_rec, nom, prenom, email, date, objet, message, `check`) 
                    VALUES (:idu, :id_rec, :nom, :prenom, :email, :date, :objet, :message, :check)";
            $stmt = $conn->prepare($sql);

            // Exécuter la requête avec les paramètres
            $stmt->execute([
                ':idu' => $this->idu,
                ':id_rec' => $this->id_rec,   // ID de la réclamation
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':email' => $this->email,
                ':date' => $this->date,
                ':objet' => $this->objet,
                ':message' => $this->message,
                ':check' => $this->check  // Initialisé à 0 par défaut
            ]);

            // Si l'insertion a réussi, retourner true
            return true;
        } catch (PDOException $e) {
            // Si une erreur survient, l'afficher
            echo "Erreur lors de l'ajout de la réclamation: " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour valider les données
    public function validate() {
        
        if (empty($this->date)) {
            throw new InvalidArgumentException('La date est requise.');
        }

        if (empty($this->objet)) {
            throw new InvalidArgumentException('L\'objet est requis.');
        }

        if (empty($this->message)) {
            throw new InvalidArgumentException('Le message est requis.');
        }
    }

    // Accesseurs (getters) pour accéder aux propriétés
    public function getIdRec() {
        return $this->id_rec;
    }

    public function getIdu() {
        return $this->idu;
    }

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

    public function getCheck() {
        return $this->check;
    }

    // Modificateurs (setters) pour modifier les propriétés

    public function setIdRec($id_rec) {
        $this->id_rec = $id_rec;
    }

    public function setIdu($idu) {
        $this->idu = (int)$idu; // Assurez-vous que l'ID est bien converti en entier
    }
    

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

    public function setCheck($check) {
        $this->check = $check;
    }
}
?>
