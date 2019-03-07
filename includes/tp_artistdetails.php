<?php
$details= 'NO ARTIST SELECTED.';

if(isset($_GET['ID'])){
    
    $Artist_ID=$_GET['ID'];
    
    $SQL_Query = 'SELECT * FROM tartist where Artist_ID= '.$Artist_ID;
    $SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);
    
    if($SQL_Select_Query){
        
        while($row= mysqli_fetch_array($SQL_Select_Query,MYSQLI_ASSOC)){
             $imgID = $row['imgID'];
            $Name = $row['Name'];
            $Country = $row['Country'];
            $Born = $row['Born'];
            $Died = $row['Died'];
            $Desc = $row['Description'];
            $Style = $row['Style'];
            
            
            $details ='<img  class="xx"  src="uploads/'.$imgID.'"  alt="Image of Artist"/>';
            $details.='<section class="custom">';
            $details.="<h2>$Name</h2>
                    <p>$Style<br/> 
                        $Country<br/>
                        $Born to $Died<br/><br/> 
                        $Desc 
            </p>";
            if(isset($_SESSION['user'])){
                if($_SESSION>50){
                    $details.='<br/><br/><a href="cse370.php?content=editArtist&ID='.$Artist_ID.'">Edit</a><br/><br/>';
                    $details .='<a href="includes/deleteArtist.php?Artist_ID='.$Artist_ID.'"> Delete </a>';
                }
            }
        }
    }

        $details.='</section>';
        
        $grid='';
            $SQL_Query = "SELECT * FROM tartobject WHERE Artist_ID=".$Artist_ID;
            $SQL_Select_Queryt = mysqli_query($dbConnected, $SQL_Query);
            if($SQL_Select_Queryt){
            $grid .= '<br/><br/><h3 class="exhibition">Works:</h3>';
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
        }?>
         
         
         
    
        
        
      
    
</html>

