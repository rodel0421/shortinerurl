<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?>
    </title>
  
    <script src="https://apis.google.com/js/api:client.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="
	sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900|Roboto&display=swap" rel="stylesheet">

    <!------ Include the above in your HEAD tag ---------->
            <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('search.css')?>
</head><?php 

$body_class = 'taro-page';
$body_other = '';
?>
<body class='<?= $body_class?>' <?= $body_other?>>
<nav class="navbar navbar-expand-lg navbar-dark static-top taro-color-nav-mobile">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="/taro/img/taro_logo.png" alt="tarotraining_logo" width="100">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse nav-taro" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item pl-4 taro-menu">
                    <?= $this->Html->link(__('Home'),
                    [ 'action' => 'searchmachine'],['class' => 'nav-link']) ?>
					</li>
					<li class="nav-item pl-4 taro-menu">
                    <?= $this->Html->link(__('About'),
                    [ 'action' => 'searchmachine'],['class' => 'nav-link']) ?>
					</li>
					<li class="nav-item pl-4 taro-menu">
                    <?= $this->Html->link(__('Services'),
                    [ 'action' => 'searchmachine'],['class' => 'nav-link']) ?>
					</li>
					<li class="nav-item pl-4 taro-menu">
                    <?= $this->Html->link(__('Contact'),
                    [ 'action' => 'searchmachine'],['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item pl-4 taro-menu">
                    <?= $this->Html->link(__('List Modules'),
                    [ 'action' => 'searchmachine'],['class' => 'nav-link']) ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>

    <?= $this->fetch('content') ?>


    <section class="bg-warning pt-5 pb-5">
    	<footer class="container py-5">
		      <div class="row">
		        <div class="col-12 col-md">
					<a class="py-2 navbar-brand" href="#">
						<img src="/taro/img/taro_logo.png" class="img-responsive" width="200">
					</a>
		          	<p>taro Training Pty Ltd
					563 Ingham Road, Mount Saint John
					QLD, 4818, Australia</p>
		        </div>
		        <div class="col-6 col-md">
		          <h5>Features</h5>
		          <ul class="list-unstyled text-small">
		            <li><a class="text-muted" href="#">Cool stuff</a></li>
		            <li><a class="text-muted" href="#">Random feature</a></li>
		            <li><a class="text-muted" href="#">Team feature</a></li>
		            <li><a class="text-muted" href="#">Stuff for developers</a></li>
		            <li><a class="text-muted" href="#">Another one</a></li>
		            <li><a class="text-muted" href="#">Last time</a></li>
		          </ul>
		        </div>
		        <div class="col-6 col-md">
		          <h5>Resources</h5>
		          <ul class="list-unstyled text-small">
		            <li><a class="text-muted" href="#">Resource</a></li>
		            <li><a class="text-muted" href="#">Resource name</a></li>
		            <li><a class="text-muted" href="#">Another resource</a></li>
		            <li><a class="text-muted" href="#">Final resource</a></li>
		          </ul>
		        </div>
		        <div class="col-6 col-md">
		          <h5>Resources</h5>
		          <ul class="list-unstyled text-small">
		            <li><a class="text-muted" href="#">Business</a></li>
		            <li><a class="text-muted" href="#">Education</a></li>
		            <li><a class="text-muted" href="#">Government</a></li>
		            <li><a class="text-muted" href="#">Gaming</a></li>
		          </ul>
		        </div>
		        <div class="col-6 col-md">
		          <h5>About</h5>
		          <ul class="list-unstyled text-small">
		            <li><a class="text-muted" href="#">Team</a></li>
		            <li><a class="text-muted" href="#">Locations</a></li>
		            <li><a class="text-muted" href="#">Privacy</a></li>
		            <li><a class="text-muted" href="#">Terms</a></li>
		          </ul>
		        </div>
		      </div>
		    </footer>
    </section>
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>

    <!-- page content -->
    <!-- page content -->
    
</body>
</html>