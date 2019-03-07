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
$C_ID = $_POST ['collectionchoice'];
$acquired= $_POST['acquired'];
$return = $_POST['return'];

if($remove){
    
    $SQL_Query ='DELETE FROM containsart WHERE Art_ID='.$artID.' AND C_ID='.$C_ID;
     if(mysqli_query($dbConnected, $SQL_Query)){
         unset($_POST['remove']);
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&RemovedC');     
    }
}else{
    $SQL_Query = 'INSERT INTO containsart (`C_ID`,`Art_ID`,`Acquired`,`ReturnDate`)';
    $SQL_Query .=" VALUES ('$C_ID','$artID','$acquired','$return')";
    
    if(mysqli_query($dbConnected, $SQL_Query)){
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&SuccessC');
        
    }else{
        $error = mysqli_error($dbConnected);
        header('Location: ../cse370.php?content=artdetails&ID='.$artID.'&'.$error);
    }
    }


?>
