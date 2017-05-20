<?php
/**This file is just for testing various classes and functions
*/

$json = $_REQUEST['json'];

$array = json_decode($json);

var_dump($array);