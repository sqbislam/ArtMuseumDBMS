

<?php
		//Secure Connection Script
            include('../../../htconfig/dbConfig.php'); 
            $dbSuccess = false;
            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);
            
            if($dbConnected){
                $CreateDB= 'Create Database '.$db['databaseArt'] ;
                
                if(mysqli_query($dbConnected, $CreateDB)) {
                    echo 'Database Created Succesfully '.$db['databaseArt'];
                    
                } else {
                    echo '<span style="color:red; ">Failed to create Database '. mysqli_error($link).'</span>';
                }                
                
            } else {
                
                echo '<span style="color:red; ">Failed to setup Connection '.$db['databaseArt'].'</span>';
                
            }

//            if ($dbConnected) {		
//                    $dbSelected = mysqli_select_db($dbConnected,$db['database']);
//                    if ($dbSelected) {
//                            $dbSuccess = true;
//                    } 	
            
            //	END	Secure Connection Script

            
