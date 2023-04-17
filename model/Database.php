<?php

    $username='root';
    $password='';
    $host='localhost';
    $database='takehome-challenge';

    $con = new PDO("mysql:host=".$host.";dbname=".$database, $username, $password);

?>