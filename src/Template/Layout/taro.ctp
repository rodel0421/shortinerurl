<?php
	$examinee = $this->request->session()->read('userTestCredentials');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?>
    </title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900|Roboto&display=swap" rel="stylesheet">
	<?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
	<?= $this->Html->css('waitMe.min.css'); ?>
    <?= $this->Html->css('taro.css')?>
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
	<script src="https://apis.google.com/js/api:client.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head><?php 

$body_class = 'taro-page';
$body_other = '';
?>
<body class='<?= $body_class?>' <?= $body_other?>>
<nav class="navbar navbar-expand-lg navbar-dark static-top taro-color-nav-mobile">
		<div class="container">
			<a class="navbar-brand" href="#">
				<?= $this->Html->Image('taro_logo.png', ['alt'=>'tarotraining_logo', 'height' => '50' , 'url' => ['controller' => 'Pages', 'action' => 'index']]); ?>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse nav-taro" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<?php if(!$examinee): ?>
						<li class="nav-item pl-4 taro-menu">
							<?= $this->Html->link(__('Home'),
							[ 'controller' => 'Pages'],['class' => 'nav-link']) ?>
						</li>
						<li class="nav-item pl-4 taro-menu">
							<?= $this->Html->link(__('My Courses'),
							[ 'controller'=> 'Courses', 'action' => 'myCourses'],['class' => 'nav-link']) ?>
						</li>

						<li class="nav-item pl-4 taro-menu">
							<?= $this->Html->link(__('My Account'),
							[ 'controller' => 'Users', 'action' => 'login'],['class' => 'nav-link']) ?>
						</li>
					<?php else: ?>
						<li class="nav-item pl-4 taro-menu">
							<?= $this->Html->link(__('Logout'),
							[ 'controller' => 'Tests', 'action' => 'logout'],['class' => 'nav-link']) ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>

    <?= $this->fetch('content') ?>

    <section class="bg-warning py-5">
    	<footer class="container py-5">
			<strong>Copyright &copy; TARO
			</strong>
		</footer>
    </section>
</body>
</html>