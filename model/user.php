<?php
require_once 'C:\xampp\htdocs\login6\config.php'; // Adjust the path if necessary

class User {
    private $idu;
    private $nom;
    private $prenom;
    private $email;
    private $naissance;
    private $tel;
    private $mdp;
    private $metier;
    private $rol;


    public function __construct($nom, $prenom, $email, $naissance, $tel, $mdp, $metier, $rol) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->naissance = $naissance;
        $this->tel = $tel;
        $this->mdp = $mdp; // Hashing the password
        $this->metier = $metier;
        $this->rol = $rol;

    }
    public function getId() {
        return $this->idu;
    }

    public function setId($idu) {
        $this->idu = $idu;
    }
    public function getnom() {
        return $this->nom;
    }

    public function setnom($nom) {
        $this->nom = $nom;
    }

    public function getprenom() {
        return $this->prenom;
    }

    public function setprenom($prenom) {
        $this->prenom = $prenom;
    }

    // Getter and setter for email
    public function getemail() {
        return $this->email;
    }

    public function setemail($email) {
        $this->email = $email;
    }
    public function getnaissance() {
        return $this->naissance;
    }

    public function setnaissance($naissance) {        
        $this->naissance = $naissance;
    }

    public function gettel() {
        return $this->tel;
    }

    public function settel($tel) {
        $this->tel = $tel;
    }


    // Getter and setter for password
    public function getmdp() {
        return $this->mdp;
    }

    public function setmdp($mdp) {
        $this->mdp = $mdp;
    }
    public function getmetier() {
        return $this->metier;
    }

    public function setmetier($metier) {
        $this->metier = $metier;
    }
    public function getrol() {
        return $this->rol;
    }

    public function setrol($rol) {        
        $this->rol = $rol;
    }


    // Save method to insert a new user into the database
    public function save() {
        $conn = Config::getConnexion();
        try {
            $sql = "INSERT INTO user (nom, prenom, email, naissance, tel, mdp) 
                    VALUES (:nom, :prenom, :email, :naissance, :tel, :mdp)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':email' => $this->email,
                ':naissance' => $this->naissance,
                ':tel' => $this->tel,
                ':mdp' => $this->mdp,

            ]);

            if ($result) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Error adding user: " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
            return false;
        }
    }
}
?>