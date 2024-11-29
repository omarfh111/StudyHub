<?php
require_once 'C:\xampp\htdocs\login6\model\user.php'; // Adjust the path if necessary
require_once 'C:\xampp\htdocs\login6\vendor\tecnickcom\tcpdf\tcpdf.php'; // Adjust to your TCPDF path
class UserController {
    
    public function addUser($nom, $prenom, $email, $naissance, $tel, $mdp, $metier, $rol) {
        $user = new User($nom, $prenom, $email, $naissance, $tel, $mdp, $metier, $rol);
        return $user->save();
    }
    public function listuser($sort = null)
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, naissance, CURDATE()) AS age FROM user";
        
        if ($sort === 'naissance') {
            $sql .= " ORDER BY naissance ASC"; // Sort by date of birth
        }
    
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
public function generateUserPDF()
{
    // Fetch user data
    $sql = "SELECT * FROM user";
    $db = config::getConnexion();
    $users = $db->query($sql)->fetchAll();

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('StudyHub');
    $pdf->SetTitle('User List');
    $pdf->SetSubject('List of Users');
    $pdf->SetKeywords('TCPDF, PDF, user, list');

    // Set default header data
    $pdf->SetHeaderData('', 0, 'LISTE DES UTILISATEURS', 'StudyHub');

    // Set margins
    $pdf->SetMargins(15, 27, 15);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Table header
    $html = '
    <h1>User List</h1>
    <table border="1" cellpadding="4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom et Prenom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Telephone</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
    ';

    // Add rows
    foreach ($users as $user) {
        $html .= '<tr>
                    <td>' . $user['idu'] . '</td>
                    <td>' . $user['nom'] . ' ' . $user['prenom'] . '</td>
                    <td>' . $user['email'] . '</td>
                    <td>' . $user['naissance'] . '</td>
                    <td>' . $user['tel'] . '</td>
                    <td>' . $user['rol'] . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('user_list.pdf', 'D'); // 'D' for download, 'I' for inline view
}
}


?>