<?php
if($_SESSION['user']>50){
      
       include('fn_fetchArtists.php');
       $postFormName='cse370.php';
    
       $allowedext = array("jpg","png","jpeg","img","bmp","pdf");
       
       $artistArray = fn_fetchArtists($dbConnected,0);
       $typeArray = '     <select name="typechoice">
                                                                    <option value="'.$type['None'].'" selected="selected">None</option>
                                                                    <option value="'.$type['Sculpture'].'" >Sculpture</option>
                                                                    <option value="'.$type['Photography'].'" >Photography</option>
                                                                    <option value="'.$type['Art'].'" >Painting</option>
                                                                    <option value="'.$type['Crafts'].'">Crafts</option>
                                                            </select>
                                                       ';
       $exhibitionArray = getexhibitions($dbConnected,0);
       
      
       
    if(isset($_POST['submit'])){
      
       $ArtistID = $_POST['artistID'];
       $File= $_FILES['fileToUpload'];
       $Title = $_POST['Title'];
       $DescR = $_POST['Desc'];
       $Desc = str_replace( "'" , ' ' ,$DescR);
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
       $destination = 'uploads/'.$fileName;
       }else{
           $fileName = '';
       }
       $flag = null;
       
       switch($typec){
           
           case $type['Sculpture'] : 
               $flag = 'S_flag';
               break;
           
           case $type['Photography'] :
               $flag = 'P_flag';
               break;
           
           case $type['Art'] :
               $flag = 'A_flag';
               break;
           case $type['Crafts'] :
               $flag = 'C_flag'; 
               break;
           
           default : $flag=null;
       }
       
       
       if($flag != null){
           
       $SQL_Query = "INSERT INTO tartobject (`Name`,`Description`,`Year`,`Location`,`imgID`,`Artist_ID`,`$flag`,`Material`,`Style`,`Dimension`,`Camera`,`Settings`)";
       $SQL_Query .= "VALUES ('$Title','$Desc','$Date','$Location','$fileName','$ArtistID',1,'$Material','$Style','$Dimension','$Camera','$Settings')";    
           
       }else{
       
       $SQL_Query = "INSERT INTO tartobject (`Name`,`Description`,`Year`,`Location`,`imgID`,`Artist_ID`,`Material`,`Style`,`Dimension`,`Camera`,`Settings`)";
       $SQL_Query .= "VALUES ('$Title','$Desc','$Date','$Location','$fileName','$ArtistID','$Material','$Style','$Dimension','$Camera','$Settings')";
       }
       
       $Sql_select = mysqli_query($dbConnected, $SQL_Query);
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


    <form action="cse370.php?content=addArt" method="post" enctype="multipart/form-data">
            Details to upload:
            <br/> 
            <br/>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            Title : <input type="text" name="Title" value=""/>
            <br/>
            Desc : <input type="text" name="Desc" value=""/>
            <br/>
            Year : <input type="text" name="Date" value=""/>
            <br/>
            Location : <input type="text" name="Location" value=""/>
            <br/>
            
            Material : <input type="text" name="Material" value=""/>
            <br/>
            
            Style : <input type="text" name="Style" value=""/>
            <br/>
            
            Dimension : <input type="text" name="Dimension" value=""/>
            <br/>
            
            
            Camera : <input type="text" name="Camera" value=""/>
            <br/>
            
            Settings : <input type="text" name="Settings" value=""/>
            <br/>
            Artist :
            <?php 
            echo $artistArray;
            echo '<br/>';
            echo 'Type: '.$typeArray . '<br/>';
            ?>
            
            <br/>
            <br/>
                            
            <input type="submit" value="Upload" name="submit">
    </form> 
</div>
</html>
