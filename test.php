<?php

require 'vendor/autoload.php';

echo "<h1>Test</h1>";

$on = Kantas_net\Database\Connection::make(require 'data/configDB.php');

$be = new Kantas_net\Database\QueryBuilder($on);

$all = $be->selectAll('images');
echo('<br>');
foreach($all as $image){
    echo '<img id="image" class="image-area" src="'.$image->imagePath.'">';
    echo('<br>');
}

var_dump($on);
echo('<br>');
var_dump($be);
echo('<br>');
var_dump($all);
die();