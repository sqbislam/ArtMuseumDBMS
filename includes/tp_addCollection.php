<?php
include_once('fn_fetchArtists.php');
if($_SESSION['user']>50){
       $postFormName='cse370?content=addCollection.php';
       $collections= getcollections($dbConnected, 0);
       
    if(isset($_POST['submit'])){
      
       $Name = $_POST['Name'];
       $Contact= $_POST['Contact'];
       $Address = $_POST['Address'];
       $Type = $_POST['Type'];
    
        $SQL_Query = "INSERT INTO collection(`Name`,`Contact no`,`Address`,`Type`)";
       $SQL_Query .= "VALUES ('$Name','$Contact','$Address','$Type')";
       if($Name!=''){
       if(mysqli_query($dbConnected, $SQL_Query)){
           echo 'Success';
           
       }else{
           echo 'Failed';
       }
       }
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

<div class="box">
    Details to upload:
    <br/>
    <br/>
    <form action="cse370.php?content=addCollection" method="post" enctype="multipart/form-data">
            
            Name: <input type="text" name="Name" value=""/>
            <br/>
            Contact No: <input type="text" name="Contact" value=""/>
            <br/>
            Address : <input type="text" name="Address" value=""/>
            <br/>
            Type: <input type="text" name="Type" value=""/>
            <br/>
            <input type="submit" value="Add " name="submit">
    </form>
<br/>
<br/>

<?php
if(isset($_SESSION['user'])){
    if($_SESSION['user']>50){
        
        $coll = '<form action="cse370.php?content=collectiondetail" method="post" >'.$collections.'
    <input type="submit" value="Delete" name="delete"/>
    <input type="submit" value="Get Details" name="details"/>
</form>
';
        echo $coll;
    }
    
}
?>

</div>
</html>