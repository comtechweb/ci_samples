<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Capthca Demo</title>
</head>
<body>

<div id="container">

	<div id="body">
		<h1>Captcha Demo</h1>

		<?php 
		if(isset($errors)){ 
			foreach ($errors as $value) {
				echo "<p>".$value."</p>";
			}
		} 
		if(isset($messages)){ 
			foreach ($messages as $message) {
				echo "<p>".$message."</p>";
			}
		}
		?>
		<?php echo validation_errors(); ?>

<form action="" method="POST">
	<p>Your Name: <input type="text" name="fname" value="<?php echo set_value('fname'); ?>"></p>

	<p>Email: <input type="email" name="email" value="<?php echo set_value('email'); ?>"></p>

	<p>
		<?php echo $captcha_image; ?>
	</p>
	<p>
		<input type="text" name="captcha" value="" />
	</p>
	<p>
		<input type="hidden" name="cword" value="<?php echo $captcha_word; ?>" />
		<input type="submit" name="submit">
	</p>


</form>




	</div>

</div>
</body>