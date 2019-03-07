<?php


/* FIle: fn_Authorise.php
 * 
 * Folder: includes
 * Author: Saqib
 * Date: 2018/7/3 10:09PM
 * Authorises username and pass
 */


function userAuthorised($dbConnected,$username,$password){
    
    $md5password=md5($password);
    
    $sql_query= "SELECT ID,password,accesslevel FROM tuser where username='$username'";
     
    
    $sql_selectQuery= mysqli_query($dbConnected, $sql_query);
    echo mysqli_error($dbConnected);
    while($row= mysqli_fetch_array($sql_selectQuery,MYSQLI_ASSOC)){
        $ID = $row['ID'];
        $passwordretrieved = $row['password'];
        $accesslevel = $row['accesslevel'];   
    }
    mysqli_free_result($sql_selectQuery);
    $returncode=false;
    if(!empty($passwordretrieved) AND ($passwordretrieved==$md5password)) {
        
        $_SESSION['user'] = $accesslevel;
       setcookie('userID', $ID, time()+7200);
        $returncode=true;
    }
        return $returncode;
        
    }
    

