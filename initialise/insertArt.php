<?php
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
            
            $Title='Minecraft';
            $Desc ='Minee';
            $Date = '';
            $Location='BANGLADESH';
            $fileName = '2214812749812712';
            $ArtistID = 2;
            

       $SQL_Query = "INSERT INTO tartobject(`Title`,`Description`,`Date`,`Location`,`imgID`,`Artist_ID`)";
       $SQL_Query .= "VALUES ('$Title','$Desc','$Date','$Location','$fileName','$ArtistID')";
       
       $Sql_select = mysqli_query($dbConnected, $SQL_Query);
      echo 'Debug:'. $Sql_select;