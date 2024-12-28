<?php

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];

    include('newconnection.php');
    // top
    include('__classstudent.php');

    $connection = new connection();
    $connection->selectDatabase('courserax');


    student::deleteStudent('student',$connection->conn,$id);

    session_destroy();
    $_SESSION  = array();
    header("Location:loginstudent.php");





}
?>