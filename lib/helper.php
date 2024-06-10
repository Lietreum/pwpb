<?php
function base_url() {
return "http://localhost/pwpb21";
}

function flash ($tipe, $pesan = '') {
  if (empty ($pesan)) {
  $pesan = @$_SESSION [$tipe];
  unset ($_SESSION[$tipe]);
  return $pesan;
  } else {
  $_SESSION [$tipe] = $pesan;
    }
  }
  
  function checkLogin () {
    $username = @$_SESSION ['username' ] ;
    $level   = @$_SESSION ['level'];
    
    if (empty ($username) AND empty ($level) ) {
    header ("location:login.php");
    }
  }
  function sudahLogin () {
    $username = @$_SESSION['username' ] ;
    $level = @$_SESSION ['level'];
    
    if (!empty($username) AND !empty($level) ) {
    header ("location:index.php");
    }
  }
  
  
