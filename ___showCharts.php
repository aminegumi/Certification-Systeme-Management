<?php

session_start();
include('__classfiliere.php');
include('newconnection.php');
include('__classstudent.php');
include('__classteacher.php');
require_once 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
$xArray = ["Completed", "In Progress", "Unenrolled"];
$yArray = [];

//$completedarray=[];$inprogressarray=[];$unenrolledarray=[];

$yes=0;
$no =0;
$unenrolled =0;
$errorMesage = "";
$successMesage = "";
$nom=str_replace("'", ' ', 'HTML, CSS, and Javascript for Web Developers');
$group=[];
$g="";
$tabcompleted = array();
$tabinprogress=array();

if(isset($_POST["submit"])){
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 

    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes) ){
        $reader = new Xlsx(); 
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
        $worksheet = $spreadsheet->getActiveSheet();  
        $worksheet_arr = $worksheet->toArray(); 
        unset($worksheet_arr[0]); 
        foreach($worksheet_arr as $row){
            
          if($nom == $row[2]){
          // Boucle pour ajouter les clés et les valeurs dans le tableau
            $groupe=explode(" ",trim($row[7]));
            $g=$groupe[2];

            if(strtolower($row[6]) == 'yes'){
              
                $tabcompleted[$g[1]] = $yes+1;
            }
            else if(strtolower($row[6]) == 'no'){
                $tabinprogress[$g[1]] = $no+1;
            }  
        }
      }
        // array_push($yArray,$yes);
        // array_push($yArray,$no);
        // $unenrolled =35-$yes-$no;
        // array_push($yArray,$unenrolled);

    } else {
        $errorMesage = 'Invalid file type';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

<div id="myPlot" style="width:100%;max-width:700px"></div>

<form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                                <label for="formFile" class="form-label">Excel file</label>
                                <input class="form-control bg-dark" type="file" id="formFile" name="file">
                         </div>
                        
                        <button type="submit" name ="submit" class="btn btn-primary py-3 w-100 mb-4">Add Groups</button>
  </form>

<script>
const xArray = <?php echo json_encode($xArray); ?>;
const yArray = <?php echo json_encode($yArray); ?>;

const layout = {title: "World Wide Wine Production"};

const data = [{labels: xArray, values: yArray, type: "pie"}];

Plotly.newPlot("myPlot", data, layout);
</script>

</body>
</html>
