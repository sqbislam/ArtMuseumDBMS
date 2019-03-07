<?php

$SQL_Query = "SELECT * FROM exhibition";
$SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);

$grid = '<div class="row">';

$count = 0;

while ($row = mysqli_fetch_array($SQL_Select_Query, MYSQLI_ASSOC)) {
    $E_ID = $row['E_ID'];
    $imgID = $row['imgID'];
    $Name = $row['Name'];
    $grid .= '<div class="containerexhi">';
    $grid .= '<a href="cse370.php?content=exhibitionDetail&ID='.$E_ID.'" class="ex1"> '
            . '<img title="Works" class="image" src="uploads/'.$imgID.'"> </a>';
    $grid .= '<div class="middle">
        <div class="text"><a href="cse370.php?content=exhibitionDetail&ID='.$E_ID.'" class="ex1">'.$Name.'</a></div>
            </div>';
   $grid .= '</div>';
    $count++;
    
    
}

$grid .='</div>';

if($count<1){
    $grid = 'NO RESULTS FOUND';
}



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
       
    
</html>




