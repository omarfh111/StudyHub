<?php
require_once 'C:\xampp\htdocs\login6\Model\EvaluationModel.php';

class EvaluationController
{
    private $model;
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new EvaluationModel($db);
    }

    // Créer une nouvelle évaluation
    public function createEvaluation($titre, $description, $questions)
    {
        return $this->model->createEvaluation($titre, $description, $questions);
    }

    // Lister toutes les évaluations
    public function getAllEvaluations()
    {
        $stmt = $this->db->query("SELECT id_evaluation, titre, description FROM evaluations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchEvaluationsByTitle($title) {
        $stmt = $this->db->prepare("
            SELECT * FROM evaluations 
            WHERE titre LIKE ?
        ");
        $stmt->execute(['%' . $title . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllEvaluationsSortedByDate() {
        $stmt = $this->db->prepare("SELECT * FROM evaluations ORDER BY date_creation DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function getAllEvaluationsu()
    {
        $stmt = $this->db->query("SELECT id_evaluation, titre, date_creation, description FROM evaluations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Récupérer une évaluation spécifique
    public function getEvaluationById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM evaluations WHERE id_evaluation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function deleteEvaluation($id)
    {
        try {
            // Commencer une transaction
            $this->db->beginTransaction();
    
            // Supprimer d'abord les réponses associées
            $stmt = $this->db->prepare("DELETE FROM reponses WHERE id_evaluation = ?");
            $stmt->execute([$id]);
    
            // Ensuite, supprimer l'évaluation
            $stmt = $this->db->prepare("DELETE FROM evaluations WHERE id_evaluation = ?");
            $stmt->execute([$id]);
    
            // Valider la transaction
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $this->db->rollBack();
            return false;
        }
    }
    
public function updateEvaluation($id, $titre, $description, $questions)
{
    // Formatter les questions avant encodage
    $formattedQuestions = [];
    foreach ($questions as $q) {
        $formattedQuestions[] = ['contenu' => $q['contenu']];
    }

    $questionsJson = json_encode($formattedQuestions); // Convertir en JSON

    // Requête pour mettre à jour l'évaluation
    $stmt = $this->db->prepare("UPDATE evaluations SET titre = ?, description = ?, questions = ? WHERE id_evaluation = ?");
    return $stmt->execute([$titre, $description, $questionsJson, $id]);
}




}
