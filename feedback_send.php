<?php
  $name = $_REQUEST['name'];  // $_REQUEST enthält die Benutzerangaben
  $email = $_REQUEST['email'];
  $message = $_REQUEST['message'];
  $lat = $_REQUEST['lat'];
  $long = $_REQUEST['long'];
  
  $geometrie = "GeomFromText ('Point($lat . " " . $long)')"

  if (isset($_REQUEST['geschlecht'])) 
     {$anrede=$_REQUEST['geschlecht'];} // Frau/Herr
  else 
     {$anrede=" ";}
     
  if (isset($_REQUEST['team'])) 
     {$team="geoweb-Mitglied";
      $teamflag=1;} 
  else 
     {$team="geoweb-extern";
      $teamflag=0;}
	
  include 'geoweb_db_open.php'; 
  


  $sql = "INSERT INTO feedback (f_name,f_mail,f_anrede,f_msg,f_geoweb,f_datum,geom)";
  $sql = $sql . "VALUES ('" . $name . "','" . $email . "','" . $anrede . 
         "','" . $message . "'," . $teamflag . ",'" . date("d-m-Y") . "','" . $geometrie . "')";
		 
  $db->exec($sql) OR DIE ('Fehler bei Speichern: '.$db->lastErrorMsg());
  
  include 'geoweb_db_close.php'; 

	echo "Danke für das Feedback!<br />Die Daten wurden per Mail übermittelt und in einer Datenbank gespeichert!";
 

?>
