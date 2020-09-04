<?php

    $conn = mysqli_connect("localhost", "root", "12345678", "mydb");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }
		
?>