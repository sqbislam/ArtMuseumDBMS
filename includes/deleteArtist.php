
<?php
      session_start();
  include('../../../htconfig/dbConfig.php'); 
            $dbSuccess = false;
            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);

            if ($dbConnected) {		
                    $dbSelected = mysqli_select_db($dbConnected,$db['databaseArt']);
                    if ($dbSelected) {
                            $dbSuccess = true;
                    } 	
            }
            

$Artist_ID = $_GET['Artist_ID'];
if(isset($_SESSION['user'])){
    if($_SESSION['user']>50){
$SQL_Query = 'DELETE FROM tartist WHERE Artist_ID='.$Artist_ID;
if(mysqli_query($dbConnected, $SQL_Query)){
    header('Location: ../cse370.php?content=showArtist&Deleted');
}else{
    $error = mysqli_error($dbConnected);
     header('Location: ../cse370.php?content=showArtist&'.$error);
}
    }
}

?>