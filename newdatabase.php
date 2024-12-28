<?php
include("newconnection.php");
include("Allquery.php");
$connection = new connection();
// $connection->createDatabase('courserax');
$connection->selectDatabase('courserax');
//$connection->createTable($querygroupe);
// $connection->createTable($queryadmin);
// $connection->createTable($queryteacher);
// $connection->createTable($queryfiliere);
// $connection->createTable($querycourse);
//  hadi hiydtha f hadi bach ndiro course concerne wahd la filiere bouhdha $connection->createTable($querycourseparfiliere); where id fil o 
// $connection->createTable($querystudent);
// $connection->createTable($querycertificat);
// $connection->createTable($querystudent_cour);
// $connection->createTable($querycoursebyadmin);
// $connection->createTable($query1);
// $connection->createTable($query2);
// $connection->createTable($query3);
// $connection->createTable($query4);
// $connection->createTable($query5);
// $connection->createTable($querynote);
// $connection->createTable($queryCourseT);
// $connection->createTable($queryCourseS);
$connection->createTable($queryMessage);
?>