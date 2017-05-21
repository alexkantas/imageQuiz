<?php

setcookie('level',1);

echo '<h1>Your Game is Reset to Level <strong>1</strong></h2>';

header( "refresh:2;url='index.html'" );