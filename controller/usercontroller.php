<?php
require_once 'C:\xampp\htdocs\login6\model\user.php'; // Adjust the path if necessary

class UserController {
    
    public function addUser($nom, $prenom, $email, $naissance, $tel, $mdp, $metier, $rol) {
        $user = new User($nom, $prenom, $email, $naissance, $tel, $mdp, $metier, $rol);
        return $user->save();
    }
    public function listuser()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteuser($idu)
    {
        $sql = "DELETE FROM user WHERE idu = :idu";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idu', $idu);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function updateStatus($userId, $metier) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE user SET metier = :metier WHERE idu = :idu");
            $stmt->execute(['metier' => $metier, 'idu' => $userId]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function updateuser($user, $idu)
{
    var_dump($user);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE user SET 
                nom = :nom,
                prenom = :prenom,
                email = :email,
                naissance = :naissance,
                tel = :tel,
                mdp = :mdp,
                metier = :metier,
                rol = :rol
            WHERE idu = :idu'
        );

        $query->execute([
            'idu' => $idu,
            'nom' => $user->getnom(),
            'prenom' => $user->getprenom(),
            'email' => $user->getemail(), 
            'naissance' => $user->getnaissance()->format('Y-m-d'),
            'tel' => $user->gettel(),
            'mdp' => $user->getmdp(), 
            'metier' => $user->getmetier(),
            'rol' => $user->getrol()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}
}

?>