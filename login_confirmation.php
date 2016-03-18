<?php
  session_start(); // before any html or spaces
  session_regenerate_id(); //regenerate session ID
   //Where did we come from?
 //  echo $_SERVER['HTTP_REFERER'];
   //Make sure we came from our own site
   if(!strstr($_SERVER['HTTP_REFERER'],	"kbrighton.greenrivertech.net"))
	die("GO AWAY, EVILDOER!");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Session 2</title>
  </head>
  <body>
	  <p>
		<?php
		  echo  $_SESSION['name'];
		  echo ", you are sucessfully registered." ;  
		  
		?>
	  </p>
   </body>
</html>
