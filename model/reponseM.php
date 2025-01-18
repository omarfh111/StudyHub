<?php

class Reponse {
    private $id_rsp;
    private $id_rec;
    private $date_rep;
    private $reponse;
    private $ok;

    // Constructeur pour initialiser les propriétés
    public function __construct($id_rec, $date_rep, $reponse, $ok) {
        
        $this->id_rec = $id_rec;
        $this->date_rep = $date_rep;
        $this->reponse = $reponse;
        $this->ok = $ok;
    }

    // Méthode pour valider les données
    public function validate() {
        if (empty($this->id_rec)) {
            throw new InvalidArgumentException('L\'ID de la réclamation est requis.');
        }

        if (empty($this->date_rep)) {
            throw new InvalidArgumentException('La date de la réponse est requise.');
        }

        if (empty($this->reponse)) {
            throw new InvalidArgumentException('La réponse est requise.');
        }

        if (!is_numeric($this->ok)) {
            throw new InvalidArgumentException('Le champ "ok" doit être un nombre (0 ou 1).');
        }
    }

    // Accesseurs (getters) pour accéder aux propriétés
    public function getIdRsp() {
        return $this->id_rsp;
    }

    public function getIdRec() {
        return $this->id_rec;
    }

    public function getDateRep() {
        return $this->date_rep;
    }

    public function getReponse() {
        return $this->reponse;
    }

    public function getOk() {
        return $this->ok;
    }

    // Modificateurs (setters) pour modifier les propriétés
    public function setIdRsp($id_rsp) {
        $this->id_rsp = $id_rsp;
    }

    public function setIdRec($id_rec) {
        $this->id_rec = $id_rec;
    }

    public function setDateRep($date_rep) {
        $this->date_rep = $date_rep;
    }

    public function setReponse($reponse) {
        $this->reponse = $reponse;
    }

    public function setOk($ok) {
        $this->ok = $ok;
    }
}

?>
