<?php

  include('../../../htconfig/dbConfig.php'); 
            $dbSuccess = false;
            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);

            if ($dbConnected) {		
                    $dbSelected = mysqli_select_db($dbConnected,$db['databaseArt']);
                    if ($dbSelected) {
                            $dbSuccess = true;
                    } 	
            }
            if(isset($_POST['add'])){
                $add = $_POST['add'];
            }
            if(isset($_POST['remove'])){
                $remove = $_POST['remove'];
            }
$artID = $_GET['artID'];
$E_ID = $_POST ['exhibitionchoice'];

echo $artID;
echo $E_ID;

if($remove){
    
    $SQL_Query ='DELETE FROM shown_At WHERE Art_ID='.$artID.' AND E_ID ='.$E_ID;
     if(mysqli_query($dbConnected, $SQL_Query)){
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&Removed');
        
    }
    
    
}else{
    $SQL_Query = 'INSERT INTO shown_At (`E_ID`,`Art_ID`)';
    $SQL_Query .="VALUES ('$E_ID','$artID')";
    
    if(mysqli_query($dbConnected, $SQL_Query)){
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&Success');
        
    }else{
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&AlreadyExists');
    }
    
    
}


?>

