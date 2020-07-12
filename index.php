<?php include("app/controllers/users.php") ?>
<?php include 'app/database/db.php'?>
<?php include 'app/database/connect.php'?>
<?php include("app/controllers/topics.php") ?>
<?php include("app/controllers/posts.php") ?>

<?php 
$all_posts=array();
$post_title='Recent Posts';

$topic_sql="select * from topics";
$rr=mysqli_query($conn,$topic_sql);
$show=mysqli_fetch_all($rr,MYSQLI_ASSOC);

if(isset($_GET['t_id']))
{
	$send=$_GET['t_id'];
	$post_title="You searched for '".$send ."'";
	$all_posts=getPostByTopic($send);
}
else if(isset($_POST['search-term']))
{
	$term=$_POST['search-term'];
	$post_title="You searched for '".$term."'";
	$all_posts=searchPosts($term);
}
else
{
	$sql="select p.*,u.username from posts as p join users as u on p.email=u.email";
	$result=mysqli_query($conn,$sql);
	$all_posts=mysqli_fetch_all($result,MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
</head>
<style type="text/css">
body{
	font-family: 'Merriweather', serif;
}
#head{
	margin-bottom: 30px;
	text-align: center;
}
a:hover{
    text-decoration:none;
}
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fade-in {
  opacity:0;  /* make things invisible upon start */
  -webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}
</style>
<script>
// document.getElementById("alarmmsg").innerHTML = msg;

setTimeout(function(){
    document.getElementById("alarmmsg").innerHTML = '';
}, 3000);
</script>
<body>
	<?php include("app/includes/header.php"); ?>
		
	<div class="ui container fade-in">
		<h1 id="head"><?php echo $post_title?></h1>

            <?php if(isset($_SESSION['message'])): ?>
            <div id="alarmmsg">
                <div class="ui green message" style="width:200px">
                    <i class="close icon"></i>
                    <div class="header">
                        Logged In
                    </div>
                </div>
                <br>
            </div>
            <?php unset($_SESSION['message']);
			      unset($_SESSION['type']); ?>
            <?php endif; ?>
        <div class="ui four stackable cards">

			<?php foreach ($all_posts as $post): ?>
			<div class="card" >
			  <div class="image">
			    <?php echo "<img src='assets/images/".$post['image']."' alt='Oops!!' style='height:175px;width:100%;'>";?>
			  </div>
			  <div class="content">
			    <a class="header" href="post.php?id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a>
			    <div class="meta">
			        <span class="date">Posted on <?php echo date('F j,Y',strtotime($post['created_at']));?></span>
			    </div>
			    <!--<div class="description">
			      <?php echo html_entity_decode(substr($post['body'],0,20)).'...'?>
			    </div>-->
			  </div>
			  <div class="extra content">
			    <a href="post.php?id=<?php echo $post['id'];?>" >
			      Read More
			    </a>
			    <span class="right floated">
			    	<i class="user icon"></i>
			    	<?php echo $post['username']?> 
			    </span>
			  </div>
			</div>
			<?php endforeach; ?>


		</div>	
            
		
	</div>
	<!--FOOTER-->
		<!--<div class="ui inverted vertical footer segment">
	        <div class="ui container foot">
	           Created by <strong>kishoreram</strong>
	        </div>
	    </div> -->
	<!--FOOTER-->
</body>
<?php include('footer.php');?>
</html>