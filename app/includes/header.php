<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<style>
#out{
	color:#e1604e;
}
a:hover{
    text-decoration:none;
}
#inside-content{
    font-size: 1.05rem;
}
#inside-content:hover{
    background-color: #F8F9F9 ;
    //color:white;
}
#inside-content1:hover{
    border: 1px solid #F8F9F9;
    background-color:#F8F9F9 ;
    font-size:1.5rem;
}
.input-box{
	border-radius: 20px;
	padding:10px;
	margin:10px 0;
	width: 100%;
	border: 1px solid #999;
	outline: none;
}

</style>
<script>
$(document).ready(function() {
  $('#but-link').click(function() {
    window.location = 'entry.php';
  })
});
</script>
<!-- HEADER -->
	<div class="ui container">
		<div class="ui stackable secondary  menu">
		  <div class="item">
		  	<h2 class="ui large header">POST.COM</h2>
		  </div>
		  <div class="right menu">
		    <div class="item">
                <div class="ui icon input">
                <form action="index.php" method="post">
                    <input type="text" name="search-term" class="input-box" placeholder="Search by title...">
                </form>   
                <i class="search link icon"></i>
                </div>
		    </div>
            <a class="item" href="index.php"><i class="home big icon"></i></a>

            <?php if(isset($_SESSION['id'])): ?>
            <div class="item" id="inside-content">
				<div class="dropdown">
				  <div id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  	<img class="ui avatar image" src="https://www.w3schools.com/howto/img_avatar.png">
				  	<strong><?php echo $_SESSION['username']; ?></strong>
				  	<i class="dropdown icon"></i>
				  </div>
				  <div class="dropdown-menu">
				    <a class="dropdown-item" href="index.php" id="inside-content1"><span>Home</span></a><br>
				    <a class="dropdown-item" href="createpost.php" id="inside-content1"><span>Write</span></a><br>
                    <a class="dropdown-item" href="newheader.php" id="inside-content1"><span>My Posts</span></a><br>
				    <a class="dropdown-item" href="destroy.php" id="inside-content1"><span class="text-danger">Sign out</span></a>
				  </div>
				</div>
			</div>
            <?php else: ?>
                <div class="item">
		  		<button class="ui green button" id="but-link">Get Started</button>
                </div>
            <?php endif; ?>

		  </div>
		</div>
	</div>
    <div class="ui divider"></div>
	<!--HEADER-->