
<?php include("app/controllers/users.php") ?>
<?php include("app/controllers/topics.php") ?>
<?php include("app/controllers/posts.php") ?>
<?php include 'app/database/connect.php' ?>
<?php include 'app/database/db.php' ?>
<?php 

if(isset($_GET['id']))
{
	$p_id=$_GET['id'];
	$qu=mysqli_query($conn,"select * from posts where id=$p_id");
	$details=mysqli_fetch_assoc($qu);

	$sql="select * from topics";
	$result=mysqli_query($conn,$sql);
	$get_topics=mysqli_fetch_all($result,MYSQLI_ASSOC);

	$sql="select * from posts";
	$result=mysqli_query($conn,$sql);
	$get_posts=mysqli_fetch_all($result,MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $details['title']?></title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<style type="text/css">
body{
	font-family: 'Merriweather', serif;
}
#head{
	font-size: 2rem;
	text-align: center;
}
#post_content{
	font-size: 1.25rem;
     word-break: break-word;
}
</style>
<body>
	
	<?php include("app/includes/header.php"); ?>

	<div class="ui container">
		<div class="ui padded text container segment">
			<p id="head"><?php echo $details['title']?></p>
            <div class="image">
                <?php echo "<img class='ui centered medium image' src='assets/images/".$details['image']."' alt='Oops!!'>";?>
            </div>
			<div id="post_content">
				<p><?php echo html_entity_decode($details['body']); ?></p>
			</div>
		</div>
	</div>

	
</body>
<?php include('footer.php');?>
</html>