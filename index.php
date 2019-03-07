<?php

/* FIle: index.php
 * 
 * Folder: htdocs
 * Author: Saqib
 * Date: 2018/7/3 12:03PM
 * 
 */

// Pre processing here to ensure login

            header("Location: cse370.php");
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
            //	END	Secure Connection Script
            
            if ($dbSuccess){
                 session_start();
                
                include_once('includes/fnAuthorise.php');
             
                
                $menuFile='';
                $contentFile='';
                $contentMsg='';
                
            
                
                if(isset($_SESSION['user'])){                                          
                    $accesslevel = $_SESSION['user'];            // gets accesslevel and userID if set
                    $userID = $_COOKIE['userID'];                             
                    $status=$_GET['status'];                                     // checks if logout is clicked and gets the status code sent back
                    $content=$_GET['content'];                                  //Gets the content code
                    
                    if(isset($status) AND $status=='logout'){               // if  status is 'logout'  then cookie for login is expired and redirected to same page
                        $_SESSION['user'] = ' ';
                        setcookie('userID','',time()-2300);
                        session_destroy();
                        header('Location: index.php');
                    } else{
                        
                        if(isset($content) AND $content=='artdisplay') {                         
                            
                            $contentFile = 'includes/tp_artDisplay.php';                            // checks content code and sets content file accordingly
                        }
                        
                         if(isset($content) AND $content=='addArt' AND $accesslevel >50) {                         
                            
                            $contentFile = 'includes/tp_artAdd.php';                            // checks content code and sets content file accordingly
                        }
                    $menuFile= 'includes/tp_artMenu.php';
                    
                    
                    }
                }                                                                                         //else block if login not authorised
                else{
                    
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                   
                    if(userAuthorised($dbConnected,$username,$password)){
                        
                        header('Location: index.php');
                    
                        
                    } else{
                    
                    $contentFile = 'includes/loginform.php';
                    }
                    
                     $contentFile = 'includes/loginform.php';
                }
                      
            }
            
            else {
                
                
            }
            
            
            

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- html headers and Css links here -->
        <link rel="stylesheet"
          type="text/css"
          href="CSS/artcss.css"/>
        <title>Art Museum</title>

    
    </head>
    
    
    <body>
        
        <h1> Welcome To Art Museum </h1>
        
        <div id="Menu">
            
            
            <?php 
            if(file_exists($menuFile)){include($menuFile);}
            ?>
            
        </div>
        
        <div id="Content">
             <?php 
            if(file_exists($contentFile)){include($contentFile);}
            ?>
        </div>
        
        
        <?php
        // put your code here
        ?>
    </body>
    <footer>
        <p>Contact Us : 01646294395385
               Email : artmusuem@gmail.com 
               Facebook : 
               Twitter : 
        </p>
    </footer>
    
    
    
</html>
