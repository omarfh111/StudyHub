<?php

require_once 'C:\xampp\htdocs\login6\Model\ReponseModel.php';

class ReponseController
{
    private $model;
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new ReponseModel($db);
    }

    // Enregistrer une nouvelle réponse
public function createReponse($id_evaluation, $id_etudiant, $reponses)
{
    $reponsesJson = json_encode($reponses);

    $stmt = $this->db->prepare("
        INSERT INTO reponses (id_evaluation, id_etudiant, reponses)
        VALUES (?, ?, ?)
    ");
    return $stmt->execute([$id_evaluation, $id_etudiant, $reponsesJson]);
}
public function updateReponseAndNotify($id_reponse, $reponses, $note, $feedback) {
    // 1. Mettre à jour la réponse avec la note et le feedback
    $stmt = $this->db->prepare("UPDATE reponses SET reponses = ?, note = ?, feedback = ? WHERE id_reponse = ?");
    $updateSuccess = $stmt->execute([json_encode($reponses), $note, $feedback, $id_reponse]);

    if ($updateSuccess) {
        // 2. Récupérer l'ID de l'étudiant
        $stmt = $this->db->prepare("SELECT id_etudiant FROM reponses WHERE id_reponse = ?");
        $stmt->execute([$id_reponse]);
        $reponse = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reponse) {
            $id_etudiant = $reponse['id_etudiant'];

            // 3. Récupérer l'email de l'étudiant
            $stmt = $this->db->prepare("SELECT email FROM users WHERE id_user = ?");
            $stmt->execute([$id_etudiant]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && isset($user['email'])) {
                $email = $user['email'];

                // 4. Envoyer un email de notification
                $subject = "Mise à jour de votre note";
                $message = "Bonjour,\n\nVotre note a été mise à jour avec succès.\n\nNote : $note\nFeedback : $feedback\n\nCordialement,\nL'équipe StudyHub";
                $headers = "From: mimoplay6394739@gmail.com";

                mail($email, $subject, $message, $headers); // Utilisation de la fonction mail()
            }
        }
        return true;
    } else {
        return false;
    }
}

public function hasUserResponded($id_etudiant, $id_evaluation) {
    $stmt = $this->db->prepare("
        SELECT COUNT(*) as total 
        FROM reponses 
        WHERE id_etudiant = ? AND id_evaluation = ?
    ");
    $stmt->execute([$id_etudiant, $id_evaluation]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] > 0; // Retourne true si une réponse existe
}


    public function getEvaluationById($id)
{
    $stmt = $this->db->prepare("SELECT * FROM evaluations WHERE id_evaluation = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function getReponsesByUser($id_etudiant) {
    $stmt = $this->db->prepare("
        SELECT r.id_reponse, r.id_evaluation, r.reponses, r.note,r.feedback, e.titre AS evaluation_titre
        FROM reponses r
        INNER JOIN evaluations e ON r.id_evaluation = e.id_evaluation
        WHERE r.id_etudiant = ?
    ");
    $stmt->execute([$id_etudiant]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getAllReponses()
    {
        $stmt = $this->db->query("SELECT * FROM reponses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getReponseById($id_reponse) {
        $stmt = $this->db->prepare("
            SELECT r.id_reponse, r.id_etudiant ,r.reponses, r.note, r.feedback, e.questions 
            FROM reponses r
            INNER JOIN evaluations e ON r.id_evaluation = e.id_evaluation
            WHERE r.id_reponse = ?
        ");
        $stmt->execute([$id_reponse]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function updateReponse($id, $reponses, $note, $feedback)
    {
        // Vérifier si $reponses est un tableau
        if (!is_array($reponses)) {
            $reponses = json_decode($reponses, true); // Décoder si c'est une chaîne JSON
        }
    
        // Encoder les réponses en JSON
        $reponsesJson = json_encode($reponses);
    
        // Mettre à jour la réponse
        $stmt = $this->db->prepare("
            UPDATE reponses 
            SET reponses = ?, note = ?, feedback = ? 
            WHERE id_reponse = ?
        ");
        return $stmt->execute([$reponsesJson, $note, $feedback, $id]);
    }
    
    
    
    public function deleteReponse($id)
    {
        $stmt = $this->db->prepare("DELETE FROM reponses WHERE id_reponse = ?");
        return $stmt->execute([$id]);
    }
    
    
}
