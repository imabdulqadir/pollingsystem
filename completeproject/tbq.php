<?php
$con=mysqli_connect('localhost', 'root','','qadirdb');
	 if(mysqli_connect_error($con))
	 {
		 echo "Failed to conect".mysqli_connect_error();
	 }
$db="create table pollingtab
(
YN char(30),
ip int(30),
PRIMARY KEY(ip)

)";
if(mysqli_query($con,$db))
	 {
	// echo "Table  Created";
     }

?>
