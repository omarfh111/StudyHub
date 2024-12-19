<?php
class EvaluationModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajouter une évaluation dans la base de données
    public function createEvaluation($titre, $description, $questions)
    {
        $stmt = $this->db->prepare("INSERT INTO evaluations (titre, description, questions) VALUES (?, ?, ?)");
        return $stmt->execute([$titre, $description, json_encode($questions)]);
    }

    // Récupérer toutes les évaluations
    public function getAllEvaluations()
    {
        $stmt = $this->db->query("SELECT id_evaluation, titre FROM evaluations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une évaluation par ID
    public function getEvaluationById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM evaluations WHERE id_evaluation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
