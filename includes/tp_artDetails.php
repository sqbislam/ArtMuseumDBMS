<?php

include('fn_fetchArtists.php');
$details= 'NO ART SELECTED.';

if(isset($_GET['ID'])){
    
    $Art_ID=$_GET['ID'];
    
    $SQL_Query = 'SELECT * FROM tartobject where Art_ID= '.$Art_ID;
    $SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);
    
    if($SQL_Select_Query){
        
        while($row= mysqli_fetch_array($SQL_Select_Query,MYSQLI_ASSOC)){
            $Art_ID = $row['Art_ID']; 
            $imgID = $row['imgID'];
            $Name = $row['Name'];
            $ArtistID = $row['Artist_ID'];
            $ID=$ArtistID;
            $Artist = fn_fetchartist($dbConnected,$ArtistID);
            
            $P_flag = $row['P_flag'];
            $S_flag = $row['S_flag'];
            $C_flag=$row['C_flag'];
            $A_flag=$row['A_flag'];
            
            if($P_flag){
                $type='Photograph';
            }
            else if($C_flag){
                $type='Craft';
           }
            else if($A_flag){
                $type='Painting';
            }
            else if($S_flag){
                $type='Sculpture';
            }
            else{
                $type='Not defined';
            }
            
            $Desc = $row['Description'];
            $Style = $row['Style'];
            
            
            $details ='<img  class="xx"  src="uploads/'.$imgID.'"  alt="Image of Artist"/>';
            $details.='<section class="custom">';
            $details.="<h2>$Name</h2><br/>";
                     
            $details.='<a href="cse370.php?content=artistdetails&ID='.$ArtistID.'" class=ex1>'.$Artist.'</a><br/>';
            $details .= '<p>'.$Style.'<br/>';
            $details.="$type <br/><br/>
                        $Desc </p>";
            
            
            if(isset($_SESSION['user'])){
                if($_SESSION['user']>50){
                $ListofExhibitions=fn_listExhibitions($dbConnected,$Art_ID);
                $ListofCollections=fn_listCollections($dbConnected,$Art_ID);
               
                $details .= '<br/><br/>'.$ListofExhibitions;
                $details .='<form action="includes/addtoExhibition.php?artID='.$Art_ID.'" method="post">Add to Exhibition: ';
                $details .= getexhibitions($dbConnected,$Art_ID);
                $details .=' <input type="submit" value="Add" name="add">';
                $details .=' <input type="submit" value="Remove" name="remove"><br/><br/>';
                $details .='</form>';
                
                $details .= '<br/><br/>'.$ListofCollections;
                $details .='<form action="includes/addtoCollection.php?artID='.$Art_ID.'" method="post"> Add to Collection: ';
                $details .= getcollections($dbConnected,$Art_ID);
                $details .=' Acquired <input type="date" name="acquired">';
                $details .=' Return <input type="date" name="return">';
                $details .=' <input type="submit" value="Add" name="add">';
                $details .=' <input type="submit" value="Remove" name="remove"><br/><br/>';
                $details .='</form>';
               
                
                $details.='<a href="cse370.php?content=editArt&ID='.$Art_ID.'&Artist_ID='.$ArtistID.'">Edit</a><br/>';
                $details .='<a href="includes/deleteArt.php?Art_ID='.$Art_ID.'"> Delete </a>';
        
                }
            }else{
                
            }
            $details.="</p>
        </section>";
            
            
            
        }
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
        }    

        ?>
         
         
         
    
        
        
      
    
</html>


