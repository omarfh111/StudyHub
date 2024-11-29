<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/evaluation.php');

class evaluationcontroller
{
    public function listevaluation()
    {
        $sql = "SELECT * FROM evaluation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteevaluation($idev)
    {
        $sql = "DELETE FROM evaluation WHERE idev = :idev";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idev', $idev);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    
    public function addevaluation($evaluation)
    {   var_dump($evaluation);
        $sql = "INSERT INTO evaluation (nom, deadline)
  
        VALUES (:nom, :deadline)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $evaluation->getnom(),
                'deadline' => $evaluation->getDeadline()->format('Y-m-d H:i:s'), 
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateevaluation($evaluation, $idev)
{
    var_dump($evaluation);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE evaluation SET nom = :nom,
                deadline = :deadline
             WHERE idev = :idev'
        );

        $query->execute([
            'idev' => $idev,
            'nom' => $evaluation->getnom(),
            'deadline' => $evaluation->getDeadline()->format('Y-m-d H:i:s'), 
        ]);

        echo $query->rowCount() ."records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


public function showevaluation($idev)
    {
        $sql = "SELECT * from evaluation where idev = $idev";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $evaluation = $query->fetch();
            return $evaluation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
