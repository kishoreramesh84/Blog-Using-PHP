<?php include("app/controllers/users.php") ?>
<?php include("app/controllers/topics.php") ?>
<?php include("app/controllers/posts.php") ?>

<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
	

	<!-- Text Area -->
	<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
	<!-- // Text Area -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
</head>
<style type="text/css">
*{
	font-family: 'Merriweather', serif;
}
.input_field{
	font-size: 1.5rem;
	font-family: 'Merriweather', serif;
}
.ck-editor__editable {
    min-height: 300px;
}
#out{
	color:#e1604e;
}
</style>
<body>
	<!-- HEADER -->
	<?php include("app/includes/header.php"); ?>
	<!--HEADER-->

	<div class="ui container">

		<?php if(sizeof($errorspo) > 0): ?>
			<div class="ui error message">
				<div class="header">
				   There were some errors with your submission
				</div>
				<ul class="list">
				<?php foreach ($errorspo as $err):?>
					<li><?php echo $err;?></li>
				<?php endforeach; ?>
				</ul>
			</div>
		<?php endif;?>

		<form action="createpost.php" method="post" enctype="multipart/form-data" class="ui fluid form">
		  <div class="ui divider"></div>
		  <div class="input_field">
		    <input type="text" placeholder="Title" name="title">
		  </div>
		  <div class="ui divider"></div>
		  <textarea id="editor" name="body"></textarea>
		        <script>
		                ClassicEditor
		                	.create( document.querySelector( '#editor' ) )
		                    .then( editor => {
		                        console.log( editor );
		                        } )
		                    .catch( error => {
		                        console.error( error );
		                        } );
		        </script>
		  <div class="ui divider"></div>
			  <select style="width: 200px" name="topic_id">
			    <option value="">Select one topic</option>
			    <?php foreach ($get_topics as $key => $top): ?>
					<?php if(!empty($show_topic_id) && $show_topic_id==$top['name']):?>
						<option value="<?php echo $top['name'];?>"><?php echo $top['name'];?></option>
					<?php else: ?>
						<option value="<?php echo $top['name'];?>"><?php echo $top['name'];?></option>
					<?php endif;?>
				<?php endforeach; ?>
			  </select>
		  <div class="ui divider"></div>
		  		<label>Image</label>
		  		<input type="file" name="image" placeholder="image">
		  <div class="ui divider"></div>
		  <button class="ui blue button" type="submit" name='add-post'>Add Post</button>
		</form>	
	</div>
</body>
<?php include('footer.php');?>
</html>