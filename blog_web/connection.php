<?php

// $host = 'localhost';
// $username = 'root';
// $password  = '';
// $dbname = 'q_blog';


// $host = 'localhost';
// $username = 'admaregierngp_johnss';
// $password  = 'EI.qjH9y(Wi,';
// $dbname = 'admaregierngp_q_blog';


$host = 'localhost';
$username = 'root';
$password  = '';
$dbname = 'q_blog';


//db name       admtpohub_q_blog
//db username   admtpohub_q_blog
//pass          EI.qjH9y(Wi,


$connection = mysqli_connect($host,$username,$password,$dbname);    ;

if (!($connection)) {
    echo 'Connection Error';
}

	


?>