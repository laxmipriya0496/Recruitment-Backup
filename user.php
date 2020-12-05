<?php
    session_start();
   if (!isset($_SESSION['user'])) {
    header('Location:/document/login/login.php'); 
    }
    else
	{
        $now = time(); // Checking the time now when home page starts.
        if ($now > $_SESSION['expire']) 
		{
           // header('Location:/asset/login/lockscreen.php'); 
   		 }
        else
		 { //Starting this else one [else1]

        }
    }
?>