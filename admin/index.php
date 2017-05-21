<?php
session_start();

if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin'] === 1){
        echo '<h5>Welcome! Please Wait!</h5>';
        header( "refresh:1;url='dashboard.html'" );
        die();
     }
}

echo '<h2>You are not Authorized!</h2>';