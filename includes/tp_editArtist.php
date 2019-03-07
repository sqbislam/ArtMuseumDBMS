<?php
$flag=true;
$Artist_ID= $_GET['ID'];
if(isset($_POST['submit'])){
    
    
       $Name = $_POST['Name'];
       $Country = $_POST['Country'];
       $Born = $_POST['Born'];
       $Died = $_POST['Died'];
       $Style = $_POST['Style'];
       $Desc = $_POST['Desc'];
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
       
         if($fileName!=''){
       $SQL_Query = "UPDATE `tartist` ";
       $SQL_Query .="SET `Name`='$Name', ";
       $SQL_Query .= "`Description`= '$Desc', ";
         $SQL_Query .="`Born`= '$Born', ";
         $SQL_Query .="`Died`='$Died', ";
         $SQL_Query .="`Style`='$Style', ";
         $SQL_Query .="`Country`='$Country', ";
         $SQL_Query .="`imgID`='$fileName' ";
         $SQL_Query .="WHERE `Artist_ID` = ".$Artist_ID;
}else{
    $SQL_Query = "UPDATE `tartist` ";
       $SQL_Query .="SET `Name`='$Name', ";
       $SQL_Query .= "`Description`= '$Desc', ";
         $SQL_Query .="`Born`= '$Born', ";
         $SQL_Query .="`Died`='$Died', ";
         $SQL_Query .="`Style`='$Style', ";
         $SQL_Query .="`Country`='$Country' ";
        
         $SQL_Query .="WHERE `Artist_ID` = ".$Artist_ID;
    
}
$flag = false;

 if(mysqli_query($dbConnected, $SQL_Query)){
           echo 'Success';
           if($filetempName != ''){
           move_uploaded_file($filetempName, $destination);
           }
        header('Location: cse370.php?content=artistdetails&ID='.$Artist_ID.'&Success');   
       }else{
           echo 'Failed';
           $error= mysqli_error($dbConnected);
           header('Location: cse370.php?content=artistdetails&ID='.$Artist_ID.'&'.$error);
       }

}else{

$SQL_Query = 'SELECT * FROM tartist WHERE Artist_ID='.$Artist_ID;
$SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);
$row= mysqli_fetch_array($SQL_Select_Query);

$Name=$row['Name'];
$Desc = $row['Description'];
$Country=$row['Country'];
$Born=$row['Born'];
$Died=$row['Died'];
$Style=$row['Style'];
    
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

<?php 
if($flag){
    echo '<form action="cse370.php?content=editArtist&ID='.$Artist_ID.'" method="post" enctype="multipart/form-data">

            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            Name : <input type="text" name="Name" value="'.$Name.'"/>
            <br/>
            Country : <input type="text" name="Country" value="'.$Country.'"/>
            <br/>
            Born : <input type="date" name="Born" value="'.$Born.'"/>
            <br/>
            Died : <input type="date" name="Died" value="'.$Died.'"/>
            <br/>
            Style : <input type="text" name="Style" value="'.$Style.'"/>
            <br/>
            Desc : <input type="text" name="Desc" value="'.$Desc.'"/>
            <br/>
            
            <input type="submit" value="Upload" name="submit">
            </form> ';
}
            ?>

    </div>


</html>