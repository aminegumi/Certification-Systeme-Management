<?php
include("__classcourse.php");
include("newconnection.php");

$connection = new connection();
$connection->selectDatabase('courserax');


if (isset($_GET['cour_id'])) {
    $CourId = $_GET['cour_id'];
    $Cours = course::selectCoursesByMatiereId($connection->conn,$CourId);
    $result = [];
    foreach ($Cours as $matiere) {
        $result[] = [
            'id_cour' => $matiere['id_Course'],
            'nom_Mcour' => $matiere['nom_Course']
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
