<?php
include("newconnection.php");
include("__classstudent.php");
include("__classteacher.php");
session_start();
$connection = new connection();
$connection->selectDatabase('courserax');

$emailErrorMsg="";
$passwordErrorMsg = "";   
if ( isset($_POST['submit'])){


$emailValue = $_POST['emailName'];
$passwordValue = $_POST['passwordName'];

if(empty($emailValue)){

    $emailErrorMsg= "email must be filled out!";
}else if(preg_match("/^[a-z]+@emsi.ma{1}$/", $emailValue)==0){

    $emailErrorMsg= "please enter a valid emsi email!";

}else if(empty($passwordValue)){
    $passwordErrorMsg= "password must be filled out!";

}else{ 
        $rowS = student::selectStudentByemail('Student',$connection->conn,$emailValue);
        $rowT = Teacher::SelectTeacherByemail('teacher',$connection->conn,$emailValue);
if (!empty( $rowS)) {
    
        if (password_verify($passwordValue, $rowS["password"])) {
            $_SESSION['idstudent'] = $rowS['id_student'];
            $_SESSION['emailstd'] = $emailValue;
            $_SESSION['firstnamestd'] = $rowS['firstname'];
            $_SESSION['lastnamestd'] = $rowS['lastname'];
            $_SESSION["password"] = $passwordValue;
            $_SESSION['groupestudent'] = $rowS['groupe'];
            $_SESSION['idfilierestudent'] = $rowS['filiereID'];
            header("Location:courses.php");
        } else {
            $passwordErrorMsg = "incorrect password!";
        }
    
}else if (!empty( $rowT)) {

    if (password_verify($passwordValue, $rowT["password"])) {
        $_SESSION['idtch'] = $rowT['id_teacher'];
        $_SESSION['emailtch'] = $emailValue;
        $_SESSION['firstnametch'] = $rowT['firstname'];
        $_SESSION['lastnametch'] = $rowT['lastname'];
        $_SESSION["passwordtch"] = $passwordValue;
        $_SESSION['idadmintch'] = $rowT['id_admin_resp'];
        header("Location:ShowCoursesTeacher.php");
    } else {
        $passwordErrorMsg = "incorrect password!";
    }

} else {
    $passwordErrorMsg = "incorrect email or password !";
}
}
}
?>