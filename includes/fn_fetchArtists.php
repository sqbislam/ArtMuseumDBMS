<?php

function fn_type($P_flag,$S_flag,$C_flag,$A_flag){
    
    $type = '<select name="typechoice">';
    
    
      
        $type.= '<option value="0" selected="selected">None</option>';           
        
if($S_flag){$type.= '<option value="1" selected="selected" >Sculpture</option>';}else{
     $type.= '<option value="1" >Sculpture</option>';
    }

if($P_flag){$type.= '<option value="2" selected="selected" >Photography</option>';}else{
     $type.= '<option value="2" >Photography</option>';
    }

if($A_flag){$type.= '<option value="3" selected="selected" >Painting</option>';}else{
     $type.= '<option value="3" >Painting</option>';
    }
    
if($C_flag){$type.= '<option value="4" selected="selected" >Crafts</option>';}else{
     $type.= '<option value="4" >Crafts</option>';
    }
    $type.= '</select>';
    
    return $type;
}

function fn_fetchArtists($dbConnected,$tick){
$SQL_Query='SELECT * FROM tartist';
$SQL_select = mysqli_query($dbConnected, $SQL_Query);

$artist= '<select name="artistID">
        <option value="0" selected="selected">..select Artist..</option>';
	 	
				while ($row = mysqli_fetch_array($SQL_select, MYSQLI_ASSOC)) {
				    $ID = $row['Artist_ID'];
				    
				    $Name = $row['Name'];
                                   if($tick == $ID){
                                       $artist .= '<option value="'.$ID.'" selected="selected">'.$Name.'</option>';
                                   }else{
				    $artist .= '<option value="'.$ID.'">'.$Name.'</option>';
                                   }               
				}
			
				mysqli_free_result($SQL_select);	
		
				$artist.= '</select>';

                return $artist;
}

function fn_fetchartist($dbConnected,$Artist){
    
  $SQL_Query = 'SELECT Name FROM tartist where Artist_ID= '.$Artist;
            $SQL_Select = mysqli_query($dbConnected, $SQL_Query);
            $row= mysqli_fetch_array($SQL_Select);
            $ArtistName = $row['Name'];
            return $ArtistName;
} 

function getcollections($dbConnected,$Art_ID){
 $SQL_QueryE = 'SELECT C_ID FROM contains WHERE Art_ID ='.$Art_ID;
$SQL_SelectE = mysqli_query($dbConnected, $SQL_QueryE);
if($SQL_SelectE){
    $row= mysqli_fetch_array($SQL_SelectE,MYSQLI_ASSOC);
$selected = '';
if($row !='' OR $row !=null){
    $selected=$row['C_ID'];
}
}

$SQL_Query='SELECT * FROM collection';
$SQL_select = mysqli_query($dbConnected, $SQL_Query);
$select= '<select name="collectionchoice"> <option value="0" selected="selected">None</option>';
if($SQL_select){	 	
				while ($row = mysqli_fetch_array($SQL_select, MYSQLI_ASSOC)) {
				    $C_ID = $row['C_ID'];
				    
				    $Name = $row['Name'];
				     if($selected==$C_ID){
                                                                                           $select.= '<option value="'.$C_ID.'" selected="selected">'.$Name.'</option>';
                                                                                       }else{
                                                                                       $select .= '<option value="'.$C_ID.'">'.$Name.'</option>';
                                                                                       }
				}
}
			
				mysqli_free_result($SQL_select);	
		
				$select.= '</select>';
                                                return $select;
                                }
                                
function getexhibitions($dbConnected,$Art_ID){
    
$SQL_QueryE = 'SELECT E_ID FROM shown_At WHERE Art_ID ='.$Art_ID;
$SQL_SelectE = mysqli_query($dbConnected, $SQL_QueryE);
$row= mysqli_fetch_array($SQL_SelectE,MYSQLI_ASSOC);
$selected = '';
if($row !='' OR $row !=null){
    $selected=$row['E_ID'];
}
    
$SQL_Query='SELECT * FROM exhibition';
$SQL_select = mysqli_query($dbConnected, $SQL_Query);

$select= '<select name="exhibitionchoice"> <option value="0" selected="selected">None</option>';
	 	
				while ($row = mysqli_fetch_array($SQL_select, MYSQLI_ASSOC)) {
				    $E_ID = $row['E_ID'];
				    
				    $Name = $row['Name'];
                                                                                       if($selected==$E_ID){
                                                                                           $select.= '<option value="'.$E_ID.'" selected="selected">'.$Name.'</option>';
                                                                                       }else{
                                                                                       $select .= '<option value="'.$E_ID.'">'.$Name.'</option>';
                                                                                       }
			
				
		
				
                                }
                                $select.= '</select>';
                                mysqli_free_result($SQL_select);	

                                                return $select;

                                }
                                
function fn_listExhibitions($dbConnected,$Art_ID){
    $output = '';
    
    $SQL_query = 'SELECT exhibition.Name,tartobject.Art_ID FROM exhibition,shown_At,tartobject '
            . 'WHERE exhibition.E_ID = shown_At.E_ID AND tartobject.Art_ID = shown_At.Art_ID AND tartobject.Art_ID='.$Art_ID;
    $SQL_Select = mysqli_query($dbConnected, $SQL_query);
    $count = 1;
    while($row = mysqli_fetch_array($SQL_Select)){
        $output .=$count.'. '.$row['Name'];
        $output .= '<br/>';
        $count++;
    }
    return $output;
    
    
}

function fn_listCollections($dbConnected,$Art_ID){
    $output = '';
    
    $SQL_query = 'SELECT collection.Name,tartobject.Art_ID FROM collection,containsart,tartobject '
            . 'WHERE collection.C_ID = containsart.C_ID AND tartobject.Art_ID = containsart.Art_ID AND tartobject.Art_ID='.$Art_ID;
    $SQL_Select = mysqli_query($dbConnected, $SQL_query);
    $count = 1;
    if($SQL_Select){
    while($row = mysqli_fetch_array($SQL_Select,MYSQLI_ASSOC)){
        $output .=$count.'. '.$row['Name'];
        $output .= '<br/>';
        $count++;
    }
    }
    return $output;
    
    
}




