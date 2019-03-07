<?php
echo HI;
if(isset($_POST['search'])){
    
    $keyword = strtolower($_POST['search']);
    if($_POST['searchchoice']=="1"){
    header("Location: ../cse370.php?content=showArtist&searchString=".$keyword);
    }else{
        header("Location: ../cse370.php?content=showArt&searchString=".$keyword);        
    }
    
}else{
    header("Location:../cse370.php");
    
}



?>
