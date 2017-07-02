<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?= $GLOBALS['config']['base_url'] ?>assets/js/script.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= $GLOBALS['config']['base_url'] ?>assets/css/site.css">

		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link rel="shortcut icon" href="<?= $GLOBALS['config']['base_url'] ?>assets/favicon.ico" />
		<link rel="icon" href="<?= $GLOBALS['config']['base_url'] ?>assets/favicon.ico" type="image/x-icon" />

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=Controller::$title ?></title>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= $GLOBALS['config']['base_url'] ?>"><img alt="Brand" class="header-img" src="<?= $GLOBALS['config']['base_url'] ?>assets/UXXX.png"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>">Home</a></li>
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>games/overview">Games</a></li>
						<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) : ?>
							<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/overview">Gebruikers</a></li>
						<?php endif; ?>
						<?php if ($GLOBALS['config']['Debug']) : ?>
							<li><a class="debug">Debug Mode</a></li>
						<?php endif; ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if (!isset($_SESSION['user']['id'])) : ?>
							<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/create">Registreer</a></li>
							<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/login">Login</a></li>
						<?php else : ?>
							<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/view/<?=$_SESSION['user']['id'] ?>">Account</a></li>
							<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/logout">Logout(<?=$_SESSION['user']['name'] ?>)</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>

		<?php require_once(__dir__.'/../'.$view); ?>

	</body>
<html>
