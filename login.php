<?php
  include 'lib/library.php';
  include 'views/v_login.php';
  sudahLogin();

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM t_login 
    WHERE username = '$username'
    AND password = SHA1('$password')";

    $t_login = $mysqli->query($sql) or die($mysqli->error);
 
    if ($t_login->num_rows != 0) {
      $row = $t_login->fetch_object();
      $_SESSION ['username'] = $row->username;
      $_SESSION ['level'] = $row->level;
      header('location:index.php');
      } else {
          $error = "Username atau password salah";
      }
    }
