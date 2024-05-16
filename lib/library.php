<?php
    session_start();

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'db_pwpb15';

    $mysqli = mysqli_connect($host, $user, $pass, $db)
             or die('Tidak dapat koneksi ke Database');  

             include 'lib/helper.php';