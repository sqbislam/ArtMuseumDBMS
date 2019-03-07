<?php

$SQL_Query = "SELECT * FROM tartobject";

if(isset($_GET['searchString'])){
    $search = $_GET['searchString'];
    $SQL_Query = "SELECT imgID,Art_ID,Name,LOWER(Name) FROM tartobject WHERE LOWER(Name) like '%$search%'";    
}
$SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);

$grid = '<div class="row">';
//$grid .= '<div class="column">';
//$table = '<table>';
$count = 0;
while ($row = mysqli_fetch_array($SQL_Select_Query, MYSQLI_ASSOC)) {
    $Art_ID = $row['Art_ID'];
    $imgID = $row['imgID'];
    $Name = $row['Name'];
    $grid .= '<div class="container">';
    $grid .= '<a href="cse370.php?content=artdetails&ID='.$Art_ID.'" class="ex1"> '
            . '<img class="image" src="uploads/'.$imgID.'"> </a>';
    $grid .= '<div class="middle"><a href="cse370.php?content=artdetails&ID='.$Art_ID.'" class="ex1">
        <div class="text">'.$Name.'</div></a>
            </div>';
   $grid .= '</div>';
    $count++;
    
    
}
//$grid .= '</div>';
$grid .='</div>';

if($count<1){
    $grid = 'NO RESULTS FOUND';
}
//$table .='</table>';


?>

<!DOCTYPE html>
<html>
    <head><meta charset="utf-8">
        
        <title> </title>
        <link rel="stylesheet" type="text/css" href="../CSS/cse370.css">
        
    </head>
    <body>
       
            <?php 
            if(isset($grid)){
                echo $grid;
            }
          
            
            ?>
        </div>
    
    
</html>


