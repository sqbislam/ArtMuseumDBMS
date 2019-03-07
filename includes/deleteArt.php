
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
            

$Art_ID = $_GET['Art_ID'];
echo $Art_ID;
if(isset($_SESSION['user'])){
    if($_SESSION['user']>50){
$SQL_Query = 'DELETE FROM tartobject WHERE Art_ID='.$Art_ID;
if(mysqli_query($dbConnected, $SQL_Query)){
    header('Location: ../cse370.php?content=showArt&Deleted');
}else{
    $error = mysqli_error($dbConnected);
     header('Location: ../cse370.php?content=showArt&'.$error);
}
    }
}
?>

