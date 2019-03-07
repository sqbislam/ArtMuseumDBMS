<?php

if(isset($_GET['ID'])){
    
    $E_ID=$_GET['ID'];
    
    $SQL_Query = 'SELECT * FROM exhibition where E_ID= '.$E_ID;
    $SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);
    
    if($SQL_Select_Query){
        
        while($row= mysqli_fetch_array($SQL_Select_Query,MYSQLI_ASSOC)){
             $imgID = $row['imgID'];
            $Name = $row['Name'];
            $Duration = $row['Duration'];
            $Start = $row['Start'];
            $End = $row['End'];
            $Location = $row['Location'];
            $Overview = $row['Overview'];
            
            $details='<div>';
            $details .='<img  class="zz"  src="uploads/'.$imgID.'"  alt="Image of exhibition"/>';
            $details.='<h3 class="exhibition">'.$Start.' to '.$End.'</h3><p class="exhibition">'.$Duration.'</p>';
            $details.='<h2 class="exhibition">'.$Name.'</h2>';
            $details.='<p class="exhibition">'.$Overview.'</p><br/><br/>';
            $details.='</div>';
        }
        
    }
    
      
        $grid='';
            $SQL_Query = "SELECT tartobject.Art_ID,imgID,Name FROM (tartobject JOIN shown_at ON tartobject.Art_ID=shown_at.Art_ID) "
                    . "WHERE shown_at.E_ID=".$E_ID;
            
            $SQL_Select_Queryt = mysqli_query($dbConnected, $SQL_Query);
            if($SQL_Select_Queryt){
            $grid .= '<br/><br/><h3 class="exhibition"></h3>';
            $grid .= '<div class="row">';
                //$grid .= '<div class="column">';
                //$table = '<table>';
                $count = 0;
                while ($row = mysqli_fetch_array($SQL_Select_Queryt, MYSQLI_ASSOC)) {
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
            }
    
    
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
        if(isset($details)){
            
            echo $details;
            echo $grid;
            
            if(isset($_SESSION['user'])){
                
                if($_SESSION['user']>50){
                    echo '<a href = "includes/deleteExhibition.php?ID='.$E_ID.'">******Delete*****</a>';
                }
            }
        }?>
         
         
         
    
        
        
      
    
</html>




