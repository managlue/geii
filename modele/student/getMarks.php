<?php   // le script pour récupérer et afficher les notes d'un élève
    
    $sql = "SELECT *
            FROM MARKS
            WHERE id_student = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id_connected);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
        var_dump($results);
    }
