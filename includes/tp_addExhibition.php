<?php

if($_SESSION['user']>50){
       $postFormName='cse370?content=addExhibition.php';
      
       
    if(isset($_POST['submit'])){
      
       $Name = $_POST['Name'];
       $File= $_FILES['fileToUpload'];
       $Duration = $_POST['Duration'];
       $OvrR = $_POST['Ovr'];
       $Ovr = str_replace( "'" , ' ' ,$OvrR);
       $Start = $_POST['Start'];
       $End = $_POST['End'];
       $Location = $_POST['Location'];
       
       $filetempName = $_FILES['fileToUpload']['tmp_name'];
       $fileExt = strtolower(end(explode(".", $_FILES['fileToUpload']['name'])));
       
       $fileName = uniqid('',true);
       $fileName = $fileName.'.'.$fileExt;
       $destination = 'uploads/'.$fileName;
       
       
       
       $SQL_Query = "INSERT INTO exhibition(`Name`,`Overview`,`Start`,`End`,`Location`,`Duration`,`imgID`)";
       $SQL_Query .= "VALUES ('$Name','$Ovr','$Start','$End','$Location','$Duration','$fileName')";
       if($Name!=''){
       $Sql_select = mysqli_query($dbConnected, $SQL_Query);
       }
       if($Sql_select){
       move_uploaded_file($filetempName, $destination);
       echo 'Success';
       } else{
           echo 'Failed: '. mysqli_error($dbConnected);
           
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
          href="artcss.css"/>
</head>

<div class="box">
    <form action="cse370.php?content=addExhibition" method="post" enctype="multipart/form-data">
            Details to upload:
            <br/>
            <br/>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            Name: <input type="text" name="Name" value=""/>
            <br/>
            Duration: <input type="text" name="Duration" value=""/>
            <br/>
            Start: <input type="date" name="Start" value=""/>
            <br/>
            End: <input type="date" name="End" value=""/>
            <br/>
            Location: <input type ="text" name="Location" value=""/>
            <br/>
            Overview: <input type ="text" name="Ovr" value=""/>
            
            <input type="submit" value="Upload " name="submit">
    </form> 
<div/>
</html>



