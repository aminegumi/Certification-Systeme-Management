<?php
include("__classMatiere.php");
include("newconnection.php");

$connection = new connection();
$connection->selectDatabase('courserax');


if (isset($_GET['filiere_id'])) {
    $filiereId = $_GET['filiere_id'];
    $matieres = Matiere::selectMatiereByfiliereId('matiere', $connection->conn, $filiereId);
    $result = [];
    foreach ($matieres as $matiere) {
        $result[] = [
            'id_Mat' => $matiere['id_Mat'],
            'nom_Matiere' => $matiere['nom_Matiere']
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Filiere ID not provided']);
    exit;
}
?>
