<?php

/* FIle: tp_artDisplay.php
 * 
 * Folder: includes
 * Author: Saqib
 * Date: 2018/8/3 03:03PM
 * 
 */

// Displays arts in database

 		//	Secure Connection Script
//            include('../../../htconfig/dbConfig.php'); 
//            $dbSuccess = false;
//            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);
//
//            if ($dbConnected) {		
//                    $dbSelected = mysqli_select_db($dbConnected,$db['databaseArt']);
//                    if ($dbSelected) {
//                            $dbSuccess = true;
//                    } 	
//            }
            //	END	Secure Connection Script

            if($dbSuccess) {
                
                $SQL_Query= 'SELECT tArtObject.*,tArtist.Name FROM tArtObject INNER JOIN tArtist ON tArtObject.Artist_ID=tArtist.Artist_ID';
                echo 'Queried with '.$SQL_Query;
                $SQL_Select_Query= mysqli_query($dbConnected, $SQL_Query);
                while($row = mysqli_fetch_array($SQL_Select_Query,MYSQLI_ASSOC)) {
                    
                    $Art_ID = $row['Art_ID'];
                    $Title = $row['Title'];
                    $Desc = $row['Description'];
                    $Year = $row['Date']; 
                    $Location = $row['Location'];
                    $Artist_ID = $row['Name'];
                    
                //echo $Art_ID;
                echo '<br/>';
                echo $Title;
                echo '<br/>';
                echo $Desc;
                echo '<br/>';
                echo $Location;
                echo '<br/>';
                echo $Year;
                echo '<br/>';
                echo $Artist_ID;
                 echo '<br/>';

                    
                }
            
                        
                
            }
