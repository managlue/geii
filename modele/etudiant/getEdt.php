<?php
    if (isset($today) && $today) $dateArray = setDate($today);
    else $dateArray = setDate();
    $max = count($dateArray);

    $sql = "SELECT heure_debut, heure_fin, salle, nom_enseignant, prenom_enseignant, nom_matiere, couleur, jour
        FROM Emploi_du_temps NATURAL JOIN Enseignant NATURAL JOIN Matiere WHERE";

    for ($cpt = 0; $cpt < $max; $cpt++) {
        $sql .= " jour = :jour$cpt";
        if ($cpt == $max-1) $sql .= ';';
        else $sql .= ' OR';
    }

    $stmt = $pdo->prepare($sql);

    $cpt = 0;
    foreach ($dateArray as $jour => $date) {
        $stmt->bindValue(":jour$cpt", $date);
        $cpt++;
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) echo "Rien pour aujourd'hui.";
    else {

        $edt = [];
        foreach ($results as $key => $result)
            $edt[$result['jour']][] = $result;

        unset($results);
        unset($result);
        unset($stmt);
        unset($sql);
?>

<div class="container">
    <div class="timetable-img text-center">
        <img src="img/content/timetable.png" alt="">
    </div>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr class="bg-light-gray">

<?php
    foreach ($dateArray as $jour => $date)
        echo ' <th class="text-uppercase">' . $jour . '</th>';
?>

                </tr>
            </thead>
            <tbody>

<?php
    $tailleMaximale = 0;
    foreach ($edt as $edtContenu) {

        $tailleEdtContenu = count($edtContenu);
        if ($tailleEdtContenu > $tailleMaximale) {
            $tailleMaximale = $tailleEdtContenu;
        }
    }

    $cpt = 0;
    $fin = false;
    while (!$fin) {
        echo '<tr>';
        foreach ($dateArray as $jour => $date){
            echo '<td>';
            if (isset($edt[$date][$cpt])) {
                echo '  <span class="bg-' . $edt[$date][$cpt]['couleur'] . ' padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">' . $edt[$date][$cpt]['nom_matiere'] . '</span>';
                echo '  <div class="margin-10px-top font-size14">' . $edt[$date][$cpt]['heure_debut'] . ' - ' . $edt[$date][$cpt]['heure_fin'] . '</div>';
                echo '  <div class="font-size13 text-light-gray">' . $edt[$date][$cpt]['nom_enseignant'] . ' ' . $edt[$date][$cpt]['prenom_enseignant'] . '</div>';
            }
            echo '</td>';
        }
        echo '</tr>';
        $cpt++;
        if ($cpt == $tailleMaximale) $fin = true;
    }
?>

            </tbody>
        </table>
    </div>
</div>

<?php
    }

    function setDate(bool $today = false): array
    {
        $weekdays = [];
        $currentDate = new DateTime();

        if ($today) {
            $jour = witchDay($currentDate->format('N'));
            $date = $currentDate->format('Y-m-d');
            $weekdays[$jour] = $date;
        }

        else {
            $dayNumber = $currentDate->format('N');

            if ($dayNumber < 6) {
                $daysToSubtract = $dayNumber - 1;
                $currentDate->modify("-{$daysToSubtract} day");
            }

            else {
                $daysToAdd = 8 - $dayNumber;
                $currentDate->modify("+{$daysToAdd} day");
            }

            for ($i = 0; $i < 5; $i++) {
                $jour = witchDay($currentDate->format('N'));
                $date = $currentDate->format('Y-m-d');
                $weekdays[$jour] = $date;

                $currentDate->modify("+1 day");
            }
        }

        return $weekdays;
    }

    function witchDay(int $jour): string
    {
        switch ($jour) {
            case '1': return 'Lundi';
            case '2': return 'Mardi';
            case '3': return 'Mercredi';
            case '4': return 'Jeudi';
            case '5': return 'Vendredi';
            case '6': return 'Samedi';
            case '7': return 'Dimanche';
            default : return 'Erreur';
        }
    }
?>
