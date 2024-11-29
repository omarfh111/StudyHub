<?php

    function deleteevaluation($idev)
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
?>