<?php


if($_SESSION['user']>50){
       $postFormName='cse370?content=addArtist.php';
      
       
    if(isset($_POST['submit'])){
      
       $Name = $_POST['Name'];
       $File= $_FILES['fileToUpload'];
       $Country = $_POST['Country'];
       $Desc = $_POST['Desc'];
       $Born = $_POST['Born'];
       $Died = $_POST['Died'];
       $Style = $_POST['Style'];
       
       $filetempName = $_FILES['fileToUpload']['tmp_name'];
       
       
       if($File != ''){
       $fileExt = strtolower(end(explode(".", $_FILES['fileToUpload']['name'])));
       
       $fileName = uniqid('',true);
       $fileName = $fileName.'.'.$fileExt;
       if($fileExt==''){
           $fileName = '';
       }
       $destination = 'uploads/'.$fileName;
       }else{
           $fileName = '';
       }
       
       $SQL_Query = "INSERT INTO tartist(`Name`,`Country`,`Born`,`Died`,`imgID`,`Description`,`Style`)";
       $SQL_Query .= "VALUES ('$Name','$Country','$Born','$Died','$fileName','$Desc','$Style')";
       if($Name!=''){
       $Sql_select = mysqli_query($dbConnected, $SQL_Query);
       }
       if($Sql_select){
       if($filetempName != ''){
           move_uploaded_file($filetempName, $destination);
           }
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

    <form action="cse370.php?content=addArtist" method="post" enctype="multipart/form-data">
            Details to upload:
            <br/>
            <br/>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            Name: <input type="text" name="Name" value=""/>
            <br/>
            Country: <input type="text" name="Country" value=""/>
            <br/>
            Born: <input type="date" name="Born" value=""/>
            <br/>
            Died: <input type="date" name="Died" value=""/>
            <br/>
            Style: <input type ="text" name="Style" value=""/>
            <br/>
            Description: <input type ="text" name="Desc" value=""/>
            
            <input type="submit" value="Upload Artist" name="submit">
    </form> 
    
    </div>
</html>
