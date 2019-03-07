<?php
include_once ('fn_fetchArtists.php');
$flag=true;
if(isset($_POST['submit'])){
    
    echo 'SUBMIT CLICKED!';
       $Art_S= $_GET['ID'];
       $Art_ID = (int)$Art_S;
       $P_flag = $_POST['P_flag'];
       $A_flag = $_POST['A_flag'];
       $S_flag = $_POST['S_flag'];
       $C_flag = $_POST['C_flag'];
       $Name=$_POST['Name'];
       $ArtistID = $_POST['artistID'];
       $File= $_FILES['fileToUpload'];
       $Title = $_POST['Title'];
       $Desc = $_POST['Desc'];
       $Date = $_POST['Date'];
       $Location = $_POST['Location'];
       $typec = $_POST['typechoice'];
       $Material = $_POST['Material'];
       $Style = $_POST['Style'];
       $Dimension = $_POST['Dimension'];
       $Camera = $_POST['Camera'];
       $Settings = $_POST['Settings'];
       
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
      
       switch($typec){
           
           case $type['Sculpture'] : 
               $S_flag = 1;
               $A_flag = 0;
               $C_flag = 0;
               $P_flag = 0;
               break;
           
           case $type['Photography'] :
               $S_flag = 0;
               $A_flag = 0;
               $C_flag = 0;
               $P_flag = 1;
               break;
           
           case $type['Art'] :
               $S_flag = 0;
               $A_flag = 1;
               $C_flag = 0;
               $P_flag = 0;
               break;
           case $type['Crafts'] :
               $S_flag = 0;
               $A_flag = 0;
               $C_flag = 1;
               $P_flag = 0;
               break;
           
           default : 
               $S_flag = 0;
               $A_flag = 0;
               $C_flag = 0;
               $P_flag = 0;
               break;
       }
       
       if($fileName!=''){
       $SQL_Query = "UPDATE `tartobject` ";
       $SQL_Query .="SET `Name`='$Name', ";
       $SQL_Query .= "`Description`= '$Desc', ";
         $SQL_Query .="`Year`= '$Year', ";
         $SQL_Query .="`Location`='$Location', ";
         $SQL_Query .="`Material`='$Material', ";
         $SQL_Query .="`Style`='$Style', ";
         $SQL_Query .="`Dimension`='$Dimension', ";
         $SQL_Query .="`Camera`='$Camera', ";
         $SQL_Query .="`Settings`='$Settings', ";
         $SQL_Query .="`P_flag`='$P_flag', ";
         $SQL_Query .="`A_flag`='$A_flag', ";
         $SQL_Query .="`C_flag`='$C_flag', ";
         $SQL_Query .= "`S_flag`=$S_flag', ";
         $SQL_Query .="`imgID`='$fileName', ";
         $SQL_Query .="`Artist_ID` ='$ArtistID' ";
         $SQL_Query .="WHERE `Art_ID` =$Art_ID";
       }else{
           $SQL_Query = "UPDATE `tartobject` ";
       $SQL_Query .="SET `Name`='$Name', ";
       $SQL_Query .= "`Description` = '$Desc', ";
         $SQL_Query .="`Year` = '$Year', ";
         $SQL_Query .="`Location` ='$Location', ";
         $SQL_Query .="`Material` ='$Material', ";
         $SQL_Query .="`Style` ='$Style', ";
         $SQL_Query .="`Dimension` ='$Dimension', ";
         $SQL_Query .="`Camera` ='$Camera', ";
         $SQL_Query .="`Settings` ='$Settings', ";
         $SQL_Query .="`P_flag` ='$P_flag', ";
         $SQL_Query .="`A_flag` ='$A_flag', ";
         $SQL_Query .="`C_flag` ='$C_flag', ";
         $SQL_Query .= "`S_flag` ='$S_flag', ";
         $SQL_Query .="`Artist_ID` ='$ArtistID' ";
         $SQL_Query .="WHERE `tartobject`.`Art_ID` = $Art_ID ";
       }
       $flag = false;
         
       if(mysqli_query($dbConnected, $SQL_Query)){
           echo 'Success';
           if($filetempName != ''){
           move_uploaded_file($filetempName, $destination);
           
           }
        header('Location: cse370.php?content=artdetails&ID='.$Art_ID.'&Success');   
       }else{
           echo 'Failed';
           $error= mysqli_error($dbConnected);
           header('Location: cse370.php?content=artdetails&ID='.$Art_ID.'&'.$error);
       }
       
}

else{

$Art_ID= $_GET['ID'];
$SQL_Query = 'SELECT * FROM tartobject WHERE Art_ID='.$Art_ID;
$SQL_Select_Query = mysqli_query($dbConnected, $SQL_Query);
$row= mysqli_fetch_array($SQL_Select_Query);

$Name=$row['Name'];
$Desc = $row['Description'];
$Year=$row['Year'];
$Location=$row['Location'];
$Material=$row['Material'];
$Style=$row['Style'];
$Dimension=$row['Dimension'];
$Camera=$row['Camera'];
$Settings=$row['Settings'];
$ArtistID = $row['Artist_ID'];
$P_flag =$row['P_flag'];
$S_flag =$row['S_flag'];
$A_flag =$row['A_flag'];
$C_flag =$row['C_flag'];
 $typeArray = fn_type($P_flag, $S_flag, $C_flag, $A_flag);
$artistArray = fn_fetchArtists($dbConnected, $ArtistID);
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
    echo '<form action="cse370.php?content=editArt&ID='.$Art_ID.'" method="post" enctype="multipart/form-data">
             
            <input type="hidden" name="A_flag" value='.$A_flag.'>
            <br/>
             <input type="hidden" name="S_flag" value='.$S_flag.'>
            <br/>
             <input type="hidden" name="C_flag" value='.$C_flag.'>
            <br/>
            <input type="hidden" name="P_flag" value='.$P_flag.'>
            <br/>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            Title : <input type="text" name="Name" value="'.$Name.'"/>
            <br/>
            Desc : <input type="text" name="Desc" value="'.$Desc.'"/>
            <br/>
            Year : <input type="text" name="Date" value="'.$Year.'"/>
            <br/>
            Location : <input type="text" name="Location" value="'.$Location.'"/>
            <br/>
            
            Material : <input type="text" name="Material" value="'.$Material.'"/>
            <br/>
            
            Style : <input type="text" name="Style" value="'.$Style.'"/>
            <br/>
            
            Dimension : <input type="text" name="Dimension" value="'.$Dimension.'"/>
            <br/>
            
            
            Camera : <input type="text" name="Camera" value="'.$Camera.'"/>
            <br/>
            
            Settings : <input type="text" name="Settings" value="'.$Settings.'"/>
            <br/>
            Artist :';
             
            echo $artistArray;
            echo '<br/>
            Type: '.$typeArray . '<br/>
            <br/>
            <br/>
                            
            <input type="submit" value="Upload" name="submit">
            </form> ';
}
            ?>
            
</div>
</html>
