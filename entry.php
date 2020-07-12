<?php include("app/controllers/users.php") ?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style type="text/css">
body{
	margin: 0;
	padding:0;
	background-position: center;
}
.fill-up{
	width: 300px;
	box-shadow: 0 0 3px 0 rgba(0,0,0,0.3);
	background: #fff;
	padding: 20px;
	margin:8% auto 0;
	text-align: center;
}
.fill-up h1{
	margin-bottom: 30px;
}
.input-box{
	border-radius: 20px;
	padding:10px;
	margin:10px 0;
	width: 100%;
	border: 1px solid #999;
	outline: none;
}
a{
	text-decoration: none;
}
hr{
	margin-top: 20px;
	width: 80%;
}
</style>
<body>
	<?php include("app/includes/header.php") ?>
	<div class="fill-up">
		<h1>Sign Up Now</h1>
        <?php if(sizeof($errors) > 0): ?>
                <div class="ui error message">
                    <div class="header">
                    There were some errors with your submission
                    </div>
                    <ul class="list">
                    <?php foreach ($errors as $err):?>
                        <li><?php echo $err;?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif;?>
		<form action="entry.php" method="post">
			
			<!-- Error part should be include -->

			<input type="text" class="input-box" placeholder="Your Username" name="username">
			<input type="email" class="input-box" placeholder="Your Email" name="usermail">
			<input type="password" class="input-box" placeholder="Your Password" name="userpass">
			<input type="password" class="input-box" placeholder="Retype Password" name="userpasscheck">
			<br><br>
			<button type="submit" name="register-btn" class="ui blue button">Sign Up</button>
			<br><br>
			<hr>
			<p class="or">OR</p>
			<p>Do you have an account ? <a href="login.php">Log In</a>
		</form>
	</div>
    <?php include('footer.php');?>
</body>
</html>