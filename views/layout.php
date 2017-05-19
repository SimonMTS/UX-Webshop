<!DOCTYPE html>
<html>
    <head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= $GLOBALS['config']['base_url'] ?>assets/css/site.css">
        <script type="text/javascript" src="<?= $GLOBALS['config']['base_url'] ?>assets/js/script.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" />
		<link rel="icon" href="<?= $GLOBALS['config']['base_url'] ?>assets/favicon.ico" type="image/x-icon" />
        <title>UXXX</title>
		
    </head>
    <body>

	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img alt="Brand" class="header-img" src="<?= $GLOBALS['config']['base_url'] ?>assets/uxxx.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
					<li><a href="<?= $GLOBALS['config']['base_url'] ?>">Home</a></li>
					<li><a href="<?= $GLOBALS['config']['base_url'] ?>pages/faq">FAQ</a></li>
					<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] > 1) : ?>
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/overview">Gebruikers</a></li>
					<?php endif; ?>
					<?php if (!isset($_SESSION['user']['id'])) : ?>
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/login">Login</a></li>
					<?php else : ?>
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/logout">Logout(<?=$_SESSION['user']['name'] ?>)</a></li>
						<li><a href="<?= $GLOBALS['config']['base_url'] ?>users/view">Portfolio</a></li>
					<?php endif; ?>
      </ul>
 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

        <div id="main-body">
            <div class="inner-body">
                <?php require_once($view); ?>
            </div>
        </div>

        <footer id="foot">
            By Simon Striekwold & Boyke.
        </footer>
    </body>
<html>
