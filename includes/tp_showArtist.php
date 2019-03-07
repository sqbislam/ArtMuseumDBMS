<?php

$SQL_Query = "SELECT * FROM tartist";

if(isset($_GET['searchString'])){
    $search = $_GET['searchString'];
    $SQL_Query = "SELECT imgID,Artist_ID,Name,LOWER(Name) FROM tartist WHERE LOWER(Name) like '%$search%'";
    
}
$SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);

$grid = '<div class="row">';

$count = 0;

while ($row = mysqli_fetch_array($SQL_Select_Query, MYSQLI_ASSOC)) {
    $ArtistID = $row['Artist_ID'];
    $imgID = $row['imgID'];
    $Name = $row['Name'];
    $grid .= '<div class="container">';
    $grid .= '<a href="cse370.php?content=artistdetails&ID='.$ArtistID.'" class="ex1"> '
            . '<img title="Works" alt="Norway" class="image" src="uploads/'.$imgID.'"> </a>';
    $grid .= '<div class="middle">
        <div class="text"><a href="cse370.php?content=artistdetails&ID='.$ArtistID.'" class="ex1">'.$Name.'</a></div>
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




