<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Capthca Demo</title>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>/css/styles.css" title="css" type="text/css" media="screen" charset="utf-8">
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


		<section>
			<h2>Controller: Generating Captcha</h2>
			<code><pre>
//Generate Random Number for captcha
$rand_numer = rand(1000, 9999);

//Initiate Captcha
$vals = array(
	'word' => $rand_numer,
    'img_path'	=> FCPATH.'/images/captcha/',
    'img_url'	=> base_url().'/images/captcha/',
    // 'font_path'	=> './path/to/fonts/texb.ttf',
    'img_width'	=> 150,
    'img_height' => 30,
    'expiration' => 7200
);

	//Generate Captcha
	$cap = create_captcha($vals);
	
			
	$this->data['captcha_image'] = $cap['image'];
	$this->data['captcha_word'] = $cap['word'];
	
			</pre></code>
			
			<h2>View: Form captcha related fields</h2>
			<code><pre>
&lt;!-- Display Captcha Image -->
&lt;p>
	&lt;?php echo $captcha_image; ?>
&lt;/p>

&lt;!-- Hidden filed to hold Captcha value -->
&lt;input type="hidden" name="cword" value="&lt;?php echo $captcha_word; ?>" />
				
			</pre></code>
			
			<h2>Controller: Form Validation for captcha</h2>
			
			<code><pre>
$this->form_validation->set_rules('captcha', 'Human Validation Code', 'required|matches[cword]');
$this->form_validation->set_rules('cword', 'Number in the image', 'required');
			</pre></code>
		</section>

	</div>

</div>
</body>