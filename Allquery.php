<?php
$querystudent= "
CREATE TABLE Student (
id_student INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(80) NOT NULL,
groupe INT UNSIGNED NOT NULL,
filiereID INT UNSIGNED NOT NULL,
FOREIGN KEY (filiereID) REFERENCES Filiere(id_Filiere) ON DELETE CASCADE ON UPDATE CASCADE
)
";

$queryMatiereTeacher= "
CREATE TABLE MatiereTeacher (
id_t INT UNSIGNED ,
id_m INT UNSIGNED ,
PRIMARY KEY(id_t,id_m),
FOREIGN KEY (id_t) REFERENCES teacher(id_teacher),
FOREIGN KEY (id_m) REFERENCES matiere(id_Mat)
)
";

$queryfiliere = "
CREATE TABLE Filiere (
id_Filiere INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nom_Filiere VARCHAR(30) NOT NULL,
id_resp INT UNSIGNED,
FOREIGN KEY (id_resp) REFERENCES admin(id_admin) ON DELETE CASCADE ON UPDATE CASCADE

)
";
$queryMatiere = "
CREATE TABLE Matiere (
id_Mat INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nom_Matiere VARCHAR(30) NOT NULL,
id_respM INT UNSIGNED,
id_filM INT UNSIGNED,
FOREIGN KEY (id_respM) REFERENCES admin(id_admin) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (id_filM) REFERENCES Filiere(id_Filiere) ON DELETE CASCADE ON UPDATE CASCADE,
)
";
// $querycourse= "
// CREATE TABLE Course (
// id_Course INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// nom_Course VARCHAR(30) NOT NULL,
// linkTOcourse VARCHAR(255) NOT NULL,
// DateLimite DATE NOT NULL
// )
// ";   ndiro l version jdida ndkhli id fil f course
$querycourse= "
CREATE TABLE Course (
id_Course INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nom_Course VARCHAR(30) NOT NULL,
linkTOcourse VARCHAR(255) NOT NULL,
// DateLimite DATE NOT NULL,
IDfiliere INT UNSIGNED NOT NULL,
FOREIGN KEY (IDfiliere) REFERENCES Filiere(id_Filiere) ON DELETE CASCADE ON UPDATE CASCADE
)
";

// $querycourseparfiliere= "
// CREATE TABLE CourseParFiliere (
// id_Cr INT UNSIGNED ,
// id_fl INT UNSIGNED ,
// PRIMARY KEY(id_Cr,id_fl),
// FOREIGN KEY (id_Cr) REFERENCES Course(id_Course),
// FOREIGN KEY (id_fl) REFERENCES Filiere(id_Filiere)
// )
// ";
$queryteacher = "
CREATE TABLE Teacher (
id_teacher INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(80),
id_admin_resp INT UNSIGNED,
FOREIGN KEY (id_admin_resp) REFERENCES admin(id_admin) ON DELETE CASCADE ON UPDATE CASCADE
)
";


$querycertificat = "
    CREATE TABLE Certificat (
     id_certif INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     id_cours INT UNSIGNED,
     note FLOAT UNSIGNED,
     Date_Delivrance DATE,
     Link_Coursera Varchar(256),
     certif_image BLOB,
     id_std INT UNSIGNED,
     FOREIGN KEY (id_cours) REFERENCES Course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (id_std) REFERENCES Student(id_student) ON DELETE CASCADE ON UPDATE CASCADE
    )
"; 


$queryadmin= "
    CREATE TABLE admin (
    id_admin INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstnameAdmin VARCHAR(30) NOT NULL,
    lastnameAdmin VARCHAR(30) NOT NULL,
    emailAdmin VARCHAR(50) UNIQUE,
    passwordAdmin VARCHAR(80)
    )
";
$querystudent_prof = "
CREATE TABLE StudentTeacher (
    id_teach INT UNSIGNED,
    id_stud INT UNSIGNED,
    PRIMARY KEY (id_teach, id_stud),
    FOREIGN KEY (id_teach) REFERENCES Teacher(id_teacher) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_stud) REFERENCES Student(id_student) ON DELETE CASCADE ON UPDATE CASCADE
)";


$queryCourseT = "
CREATE TABLE CourseTeacher (
    id_courseTeach INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    IDteach INT UNSIGNED,
    IDcrs INT UNSIGNED,
    FOREIGN KEY (IDteach) REFERENCES Teacher(id_teacher) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IDcrs) REFERENCES Course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE
)";
$queryCourseS = "
CREATE TABLE CourseStudent (
    id_courseStud INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    IDfiliero INT UNSIGNED,
    groupo INT UNSIGNED,
    IDcrs INT UNSIGNED,
    DateLimite DATE NOT NULL,
    FOREIGN KEY (IDfiliero) REFERENCES Filiere(id_Filiere) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IDcrs) REFERENCES Course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE
)";

$queryMessage = "
CREATE TABLE messages (
    id_msg INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED,
    course_id INT UNSIGNED,
    message_text TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES Student(id_student) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (course_id) REFERENCES Course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE
)
";
?>
<?php
// $queryteacher_cour= "
//     CREATE TABLE teacher_cour (
//     id_teacherC VARCHAR(30) ,
//     id_courseD INT UNSIGNED ,
//     PRIMARY KEY(id_teacherC,id_courseD),
//     FOREIGN KEY (id_teacherC) REFERENCES Teacher(id_teacher),
//     FOREIGN KEY (id_courseD) REFERENCES Course(id_Course)
//     )
// ";

// $querystudent_cour = "
//     CREATE TABLE student_cour (
//     id_StudentS INT(10) UNSIGNED ,
//     id_courseS INT UNSIGNED ,
//     PRIMARY KEY(id_StudentS,id_courseS),
//     FOREIGN KEY (id_StudentS) REFERENCES Student(id_student),
//     FOREIGN KEY (id_courseS) REFERENCES Course(id_Course)
//     )
// ";

// $querygroupe= "
// CREATE TABLE Groupe (
// id_Groupe INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// nom_Groupe VARCHAR(30) NOT NULL
// )
// ";

// $querycoursebyadmin = "
//     CREATE TABLE CourseByAdmin(
//         id_adminA VARCHAR(30),
//         id_CourseA INT UNSIGNED,
//         PRIMARY KEY(id_AdminA,id_CourseA),
//         FOREIGN KEY (id_courseA) REFERENCES Course(id_Course),
//         FOREIGN KEY (id_adminA) REFERENCES admin(id_admin)
//     )
// ";


// $query1=" ALTER TABLE admin
// ADD COLUMN id_fil INT UNSIGNED,
// ADD CONSTRAINT FOREIGN KEY (id_fil) REFERENCES Filiere (id_Filiere)";

// $query2=" ALTER TABLE groupe
// ADD COLUMN id_fil1 INT UNSIGNED,
// ADD CONSTRAINT FOREIGN KEY (id_fil1) REFERENCES Filiere (id_Filiere)";
// $query3="
// CREATE TABLE teacher_groupe(
//     id_prof1 VARCHAR(30),
//     id_groupe1 INT UNSIGNED,
//     Primary Key (id_prof1,id_groupe1),
//     FOREIGN KEY (id_prof1) REFERENCES Teacher (id_teacher),
//     FOREIGN KEY (id_groupe1) REFERENCES groupe(id_Groupe)

// )";

// $query4=" ALTER TABLE Course
// ADD COLUMN linkTOcourse VARCHAR(255)";


// $query5=" ALTER TABLE Certificat
// ADD COLUMN certificat_image BLOB";


// $querynote="
// CREATE TABLE NOTE(
//     id_etudiantNote INT UNSIGNED,
//     id_noteCertificate INT UNSIGNED,
//     note Float CHECK (note between 0 and 20),
//     PRIMARY KEY(id_etudiantNote,id_noteCertificate),
//     FOREIGN KEY (id_etudiantNote) REFERENCES Student(id_student),
//     FOREIGN KEY (id_noteCertificate) REFERENCES Certificat(id_certif)
    
// )";

$queryprogress="CREATE TABLE PROGRESS (
    idp INT UNSIGNED AUTOINCREMENT PRIMARY KEY,
    idcs INT ,
    pcompleted float,
    punenrolled float,
    pinprogress float,
    FOREIGN KEY (idcs) REFERENCES course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE,
    gp int,
    datep date DEFAULT SYSDATE,

);";

// CREATE TABLE PROGRESS (

//     idp INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     idcs INT ,
//     pcompleted FLOAT,
//     punenrolled FLOAT,
//     pinprogress FLOAT,
//     FOREIGN KEY (idcs) REFERENCES course(id_Course) ON DELETE CASCADE ON UPDATE CASCADE,
//     gp INT,
//     datep DATE DEFAULT SYSDATE()

// );
?>