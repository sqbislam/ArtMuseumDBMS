<?php

//		File in initialise folder:              create_tUser.php

 		//	Secure Connection Script
            include('../../../htconfig/dbConfig.php'); 
            $dbSuccess = false;
            $dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);

            if ($dbConnected) {		
                    $dbSelected = mysqli_select_db($dbConnected,$db['databaseArt']);
                    if ($dbSelected) {
                            $dbSuccess = true;
                    } 	
            }
            //	END	Secure Connection Script


    $newTableName = "tArtObject";

    		//	drop & create table
            $dropTestTable = 'DROP TABLE '.$newTableName;
                    if (mysqli_query($dbConnected,$dropTestTable))  {	
                            echo 'Table Dropped.<br /><br />';
                    } else {
                            echo '<span style="color:red; ">
                                            FAILED to DROP table.'.$newTableName.'</span>
                                            <br /><br />';
                            echo mysqli_error($dbConnected);
                    }

            $createTestTable = 'CREATE TABLE '.$newTableName.' (
                                                                    Art_ID INT NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
                                                                    Title VARCHAR( 100 ) NOT NULL, 
                                                                    Description varchar(300), 
                                                                    Date date,
                                                                    Location varchar(100),
                                                                    Artist_ID INT NOT NULL,
                                                                    
                                                                    FOREIGN KEY (Artist_ID) REFERENCES tArtist(Artist_ID)
                                                                    
                                                            )';		

                    if (mysqli_query($dbConnected,$createTestTable))  {	
                            echo '<br />Table '.$newTableName.' Added.<br /><br />';
                    } else {
                            echo '<span style="color:red; "><br />FAILED to Add table '
                                            .$newTableName.'.</span><br /><br />';
                            echo mysqli_error($dbConnected);
                    }
    

?>