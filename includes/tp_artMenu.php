<?php

/* FIle: tp_artMenu.php
 * 
 * Folder: includes
 * Author: Saqib
 * Date: 2018/7/3 10:09PM
 * 
 */
?>


<h2> <a href="index.php"> Plan Your Visit </a> </h2>
           
<h2><a href="index.php?content=showArt">  Arts </a> </h2>
<h2> <a href="index.php">  Artists </a></h2>
<h2> <a href="index.php">   Exhibitions </a></h2>

<br/>
<a href="index.php?content=artdisplay" > Display Art </a>
<br/>
<a href="index.php?status=logout" >Logout</a>


<?php
if((isset($_SESSION['user'])) AND ($_SESSION['user']>50)){
echo'<a href="index.php?content=addArt">Template box link</a>';
echo '<br/>';
echo'<a href="../ArtMuseum/initialise"> Create tables</a>';
}
        ?>