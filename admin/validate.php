<?php

session_start();

if(isset($_POST['password'])){
    if($_POST['password']===(require '../data/coreData.php')['password']){
        $_SESSION['isAdmin'] = 1;
        echo '<h1>Validation Completed! You are Admin now!</h1>';
        header( "refresh:2;url='index.php'" );
        die();
    }
    echo '<h2>Wrong Password!</h2>';
}
?>
<form action="validate.php" method="post">
  Password<br>
  <input type="password" name="password">
  <input type="submit" value="Submit">
</form>
