<?php

class ReponseModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Enregistrer une réponse
    public function createReponse($id_evaluation, $id_etudiant, $reponses)
    {
        $stmt = $this->db->prepare("INSERT INTO reponses (id_evaluation, id_etudiant, reponses) VALUES (?, ?, ?)");
        $stmt->execute([$id_evaluation, $id_etudiant, json_encode($reponses)]);
        return $this->db->lastInsertId();
    }

    // Récupérer les réponses pour une évaluation
    public function getReponsesByEvaluation($id_evaluation)
    {
        $stmt = $this->db->prepare("SELECT * FROM reponses WHERE id_evaluation = ?");
        $stmt->execute([$id_evaluation]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour une réponse après correction
    public function updateReponse($id, $note, $feedback)
    {
        $stmt = $this->db->prepare("UPDATE reponses SET note = ?, feedback = ? WHERE id_reponse = ?");
        return $stmt->execute([$note, $feedback, $id]);
    }
}
