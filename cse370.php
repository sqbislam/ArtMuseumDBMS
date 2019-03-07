<?php

/* File: cse370.php
 * Author : Saqib Islam & Rifah Sama Aziz
 * Date:3/13/2018
 * 
 * This is the base page on which the web application runs on
 */


//	Secure Connection Script
            include('../../htconfig/dbConfig.php'); 
            $dbSuccess = false;
            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);

            if ($dbConnected) {		
                    $dbSelected = mysqli_select_db($dbConnected,$db['databaseArt']);
                    if ($dbSelected) {
                            $dbSuccess = true;
                    } 	
            }
  // END	Secure Connection Script
            
if($dbSuccess){
    session_start();
include_once('includes/fnAuthorise.php');


$homeString= '<img src="art.jpg"  alt="Pictures" class="homeimg" />  
                      <section>
                        <li><a href="" class="ex1">Learning Art</a></li>
	  <p> Art makes you feel beauty of freedom. It is free expression
	  of human mind and senses.An expression which is not subdue to 
	  any kind of utility,if you dont desire; an expression which 
	  only aims at her own existence, at her own beauty.
                    Art is the creativity in oneself that defines a person. It is said to be the 
                    ultimate mental peace that heals the most wounded parts
                    .Art defines your true underlying nature that cannot be sensed through any other method.
            

</p>
                     <section>';

if(isset($_GET['content'])){
    $content= $_GET['content'];

    switch($content){
            case 'addArt':
                $contentFile = ('includes/tp_artAdd.php');    
                 break;
            case 'showArt':
                $contentFile = ('includes/tp_showArt.php');
                break;
            case 'addArtist';
                $contentFile = ('includes/tp_artistAdd.php');
                break;
            case 'showArtist':
                $contentFile = ('includes/tp_showArtist.php');
                break;
            case 'artistdetails':
                $contentFile = ('includes/tp_artistdetails.php');
                break;
            case 'artdetails':
                $contentFile = ('includes/tp_artdetails.php');
                break;
            
             case 'addExhibition':
                $contentFile = ('includes/tp_addExhibition.php');
                break;
            
            case 'showExhibition':
                $contentFile = ('includes/tp_showExhibition.php');
                break;
            
             case 'addCollection':
                $contentFile = ('includes/tp_addCollection.php');
                break;
            
             case 'editArtist':
                $contentFile = ('includes/tp_editArtist.php');
                break;
            
             case 'editArt':
                $contentFile = ('includes/tp_editArt.php');
                break;
            
            case 'exhibitionDetail':
                $contentFile=('includes/tp_exhibitionDetail.php');
                break;
            case 'collectiondetail':
                $contentFile=('includes/collectiondetails.php');
                break;
            
            default: 
                $contentFile = null;
}

}
//user authentication

if(!isset($_SESSION['user'])){
$loginForm= '
<form action="cse370.php" method="post" class="ex2">         
    <button name="login" type="submit">Login</button> </form>
    ';
//if submit button is pressed
if(isset($_POST['submit'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
     error_reporting(E_ALL ^ E_NOTICE);  

     if(userAuthorised($dbConnected,$username,$password)){
                       
                        //header('Location: cse370.php');
                        $loginForm='Logged in <a href="cse370.php?status=logout">logout </a>';
                        
                    }else{ unset($_POST['submit']); }
                   
}

//if login button is pressed
if(isset($_POST['login'])) {
    
$loginForm = '<form action="cse370.php" method="post" class="ex2" >
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td align="right"> <input type="submit" name="submit" value ="Submit"> </td>
<td>&nbsp</td>

<td align="right"><input type="password" name="password" placeholder="Password" ></td>

<td>&nbsp</td>

<td align="right"><input type="text" name="username" placeholder="User Name" ></td>

</tr>
</table>
</form>';
unset($_POST['login']);
}

}

else{
    $loginForm='Logged in <a href="cse370.php?status=logout">logout </a>';
    
    $accesslevel = $_SESSION['user'];            // gets accesslevel and userID if set
    
   // $userID = $_COOKIE['userID'];    
   if(!empty($_GET['status'])){
   $status=$_GET['status']; 
   }// checks if logout is clicked and gets the status code sent back
   
    error_reporting(E_ALL ^ E_NOTICE);  
    
    if(isset($status) AND $status=='logout'){               // if  status is 'logout'  then cookie for login is expired and redirected to same page
                        $_SESSION['user'] = ' ';
                        setcookie('userID','',time()-2300);
                        session_destroy();
                        header('Location: cse370.php');
                    }


}



}


?>



<!DOCTYPE html>
<html lang= "en">
<head>
<meta charset="UTF-8">

<title> La Rouge </title>
<link rel="stylesheet" type="text/css" href="CSS/cse370.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <p align="right"  class="loggedIn">
        
    <?php
    if(isset($loginForm)){
        echo $loginForm;
    }
        ?>
        
    </p>



	<header class="banner">
	
                       <h1> La Rouge </h1>
  
	</header>
	 
	
	<main>
		
		<nav>
			<ul>
                                <li><a href="cse370.php" class="ex1">Plan Your Visit</a></li>
                                <li><a href="cse370.php?content=showArt" class='ex1' >Arts</a></li>
	             <li><a href="cse370.php?content=showArtist" class='ex1'>Artists</a></li>
                                <li><a href="cse370.php?content=showExhibition" class="ex1">Exhibitions</a></li>
                                <li>  <div class="search-container">
                                            <form action="includes/searchProcess.php" method="post">
                                                            <input type="text" placeholder="Search.." name="search">
                                                            <select name="searchchoice">
                                                                    <option value="0" selected="selected">Arts</option>
                                                                    <option value="1">Artists</option>
                                                            </select>
                                                            <button type="submit"><i class="fa fa-search"></i></button>
                                               
                                            </form>
                                       </div> 
                                </li>
                                <?php
                                if(isset($_SESSION['user']) AND $_SESSION['user']>50){
                                echo '<a href="cse370.php?content=addArt" class="ex1">AddArt &nbsp;&nbsp; </a>';
                                echo '<a href="cse370.php?content=addArtist" class="ex1">AddArtist &nbsp;&nbsp; </a>';
                                echo '<a href="cse370.php?content=addExhibition" class="ex1">AddExhibition &nbsp;&nbsp; </a>';
                                echo '<a href="cse370.php?content=addCollection" class="ex1">AddCollection &nbsp;&nbsp; </a>';
                                }
                                ?>
			</ul>
		</nav>
           
	 
 <?php
 if(isset($contentFile) AND $contentFile!=null){
     include_once ($contentFile);
 }else{
 echo $homeString;
 
 }
                ?>

        </main>   
    
    <footer>
		
		<a href="cse370.php" class="fa fa-facebook" > </a>
		<a href="cse370.php" class="fa fa-twitter" ></a>
		<a href="cse370.php" class="fa fa-instagram" ></a>
                                        <a href="cse370.php" class="fa fa-google-plus"></a>
                                       <aside class="ending"> Contact Information: </br>
		128 Madison Avenue </br>
		Paris, France 75009 </br>
		Phone : +33-3213-188-321 </aside>	  
   </footer>
</body>
   </html>
 
 

