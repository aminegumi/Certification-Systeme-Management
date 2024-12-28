<?php if (isset($_POST['uploadcertif'])) {

    $link = $_POST['linkcertif'];
    $certifimg = $_FILES['filecertif']['name']; // Use $_FILES for file uploads
    $ids = $_SESSION['idstudent'];

    if (empty($link) || empty($certifimg)) {
        $error = "All fields must be filled out!";
    } else {
        // Vérifier si le lien est un URL valide
        if (filter_var($link, FILTER_VALIDATE_URL) === false) {
            $error = "Invalid URL format";
        } else {
            // Le reste de votre code pour traiter le certificat
            // ...

            // Si tout est valide, rediriger ou effectuer d'autres actions nécessaires
        }
    }
}
?>