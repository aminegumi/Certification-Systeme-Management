<?php
// export.php
include('newconnection.php');
include('__classfiliere.php');
session_start();
$groupe=$_SESSION['groupies'];
$Fil=$_SESSION['filierii'];
$connection = new connection();
$connection->selectDatabase('courserax');
$nameMajor = filiere::selectfiliereById('filiere',$connection->conn,$Fil);
include 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST["file_content"])) {
    $temporary_html_file = './tmp_html/' . time() . '.html';

    if (!file_exists('./tmp_html')) {
        mkdir('./tmp_html', 0777, true); // Create the directory if it doesn't exist
    }

    if (file_put_contents($temporary_html_file, $_POST["file_content"]) !== false) {
        try {
            $reader = IOFactory::createReader('Html');
            $reader->setLoadSheetsOnly(0); // Load only the first sheet

            $spreadsheet = $reader->load($temporary_html_file);

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

            $filename = $nameMajor['nom_Filiere'].'-G'.$groupe.'.xlsx';

            $writer->save($filename);

            // Set headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filename));

            // Read and output the file
            readfile($filename);

            // Clean up: delete temporary files
            unlink($temporary_html_file);
            unlink($filename);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Error writing HTML content to file.';
    }

    exit;
}
?>
