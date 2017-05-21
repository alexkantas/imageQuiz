<?php

$json = $_POST['json'];

$results = json_decode($json);

$level = $_COOKIE['level'] ?? 1 ;

$level++;

setcookie('level',$level);

$index = 1 ;

?>
<!DOCTYPE html>
<!--
Copyright 2017 Kantas.net
Released under the Apache Version 2.0 License
( http://www.apache.org/licenses/LICENSE-2.0 )
-->
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
	<meta name="author" content="Kantas.net">
	<title>ImageQuiz</title>
	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

</head>

<body>

	<nav class="light-blue lighten-1" role="navigation">
		<div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo">FaceNameGame</a>
		</div>
	</nav>

	<div class="container">

		<div class="row">
			<div class="col s12 m8 offset-m2">
				<h2>Results</h2>
				<ul class="collection with-header">
					<?php foreach($results as $result): ?>
					<li class="collection-header">
						<h4>Question <?= $index ?></h4>
					</li>
					<li class="collection-item">
						<?php if($result->helps == 0) :?>
						<div>You answered correctly without use any help<a class="secondary-content"><i class="material-icons">pan_tool</i></a></div>
						<?php else: ?>
						<div>You used help <strong><?= $result->helps ?></strong> times <a class="secondary-content"><i class="material-icons">pan_tool</i></a></div>
						<?php endif ?>
					</li>
					<li class="collection-item">
						<div>You give the right anwser in <strong><?= $result->time ?></strong> seconds <a class="secondary-content"><i class="material-icons">alarm</i></a></div>
					</li>
					<?php $index++; endforeach ?>
				</ul>
				<div class="center-align">
				<a href="index.html" id="start-button" class="blue waves-effect waves-light btn-large">Go to level <?= $level ?> !</a>
				</div>
			</div>

			<div class="fixed-action-btn">
			<a href="reset.php" title="Reset to Level 1" class="btn-floating btn-large waves-effect waves-light blue"><i class="material-icons">settings_backup_restore</i></a>
			</div>

		</div>
	</div>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>

</body>

</html>