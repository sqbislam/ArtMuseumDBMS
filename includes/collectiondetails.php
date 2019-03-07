<?php

$ID = $_POST['collectionchoice'];

if(isset($_POST['details'])){
    $details = $_POST['details'];
}
if(isset($_POST['delete'])){
    $delete = $_POST['delete'];
    
}

if($delete){
    $SQL_Query = 'DELETE FROM collection WHERE C_ID='.$ID;
    
    if(mysqli_query($dbConnected, $SQL_Query)){
        header('Location:cse370.php?content=addCollection&deleted');
    }else{
        $error = mysqli_error($dbConnected);
        header('Location:cse370.php?content=addCollection&'.$error);
    }
    
}
else if($details){
    $SQL_Query = 'SELECT * FROM collection WHERE C_ID='.$ID;
    $Sql_select = mysqli_query($dbConnected, $SQL_Query);
    if($Sql_select){
        
       $row = mysqli_fetch_array($Sql_select,MYSQLI_ASSOC);
            
       $Name = $row['Name'];
       $Contact = $row['Contact no'];
       $Address = $row['Address'];
       $Type = $row['Type'];
            
            
        
    }


    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          type="text/css"
          href="../CSS/cse370.css"/>
</head>
<body>
<?php

echo '<h3> Name: '.$Name.'  </h3><br/>
            <h3> Contact No: '.$Contact.'</h3>
            <h3> Address: '.$Address.'</h3>
            <h3> Type: '.$Type.'</h3>';

?>
    </body>
</html>
