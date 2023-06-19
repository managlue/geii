<?php
    if (!isset($today)) $today = false;
    $noIsset = true;

    if (isset($_POST['moins'])) {
        $noIsset = false;

        if ($today) $change = '-1 day';
        else $change = '-1 week';

        changeDate($change, $today);
    }

    if (isset($_POST['plus'])) {
        $noIsset = false;

        if ($today) $change = '+1 day';
        else $change = '+1 week';

        changeDate($change, $today);
    }

    if ($noIsset) {
        if ($today) $_SESSION['date'] = setDate($today);
        else $_SESSION['date'] = setDate();
        $_SESSION['max'] = count($_SESSION['date']);
    }

    $dateArray =  $_SESSION['date'];
    $max = $_SESSION['max'];

    $sql = "SELECT heure_debut, heure_fin, salle, nom_enseignant, prenom_enseignant, nom_matiere, couleur, jour
        FROM Emploi_du_temps NATURAL JOIN Matiere NATURAL JOIN Enseignant WHERE";

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
?>

<form method="post" action="">
    <button id="sidebarCollapse" type="submit" class="btn btn-light bg-white rounded-pill shadow-sm px-3 mb-4" name="moins">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>

<?php
    if ($today) echo "Jour précédent";
    else echo 'Semaine précédente';
?>

    </button>ㅤ
    <button id="sidebarCollapse" type="submit" class="btn btn-light bg-white rounded-pill shadow-sm px-3 mb-4" name="plus">

<?php
    if ($today) echo "Jour suivant";
    else echo 'Semaine suivante';
?>

        <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </button>
</form>


<?php
    $edt = [];
    foreach ($results as $key => $result)
        $edt[$result['jour']][] = $result;

    unset($result);
    unset($stmt);
    unset($sql);
?>

<div class="container">
    <div class="timetable-img text-center">
        <img src="img/content/timetable.png" alt="">
    </div>
    <div class="table-responsive">

        <table class="table table-light table-bordered text-center">
            <thead>
                <tr>

<?php
    foreach ($_SESSION['date'] as $jour => $date)
        echo ' <th class="text-uppercase">' . "$jour<br>$date</th>";
?>

                </tr>
            </thead>
            <tbody>

<?php
    if (empty($results)) {
        echo '<tr>';
        if ($today) echo "<td>Rien pour aujourd'hui.";
        else echo '<td colspan="5">Rien pour cette semaine.';
        echo '</td></tr>';
    }
    else {

        $tailleMaximale = 0;
        foreach ($edt as $edtContenu) {

            $tailleEdtContenu = count($edtContenu);
            if ($tailleEdtContenu > $tailleMaximale) $tailleMaximale = $tailleEdtContenu;
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
    }
?>

            </tbody>
        </table>
    </div>
</div>

<!-- fonctions php -->
<?php
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

    function changeDate(string $change, bool $today = false): void
    {
        foreach ($_SESSION['date'] as $jour => &$date) {
            $newDate = new DateTime($date);
            $newDate->modify($change);
            $date = $newDate->format('Y-m-d');
        }
        
        if ($today) $_SESSION['date'] = [witchDay($newDate->format('N')) => $date];
    }
?>
