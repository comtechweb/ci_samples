<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div id="container">

	<div id="body">
		<p><?php echo anchor(base_url(), "Home"); ?></p>
		<h1>Batch Insert Sample</h1>

		<div>
			<p>Table Name: friends</p>
			<p>Notes: Users are manually coded for sample. Demonstrate Batch Insert and Batch Update</p>
			<p>Important part is how form fields named and catched those data on the controller to feed the CondeIgniter's batch_insert() and batch_update().</p>
		</div>

		<form id="batch_insert" action="" name="form_batch_insert" method="post">
			<p>Select User: 
				<select name="select_user_id">
					<option value="1" <?php echo ($user_id==1)?"selected='selected'":""; ?>>Jagath</option>
					<option value="2" <?php echo ($user_id==2)?"selected='selected'":""; ?>>Saman</option>
					<option value="3" <?php echo ($user_id==3)?"selected='selected'":""; ?>>Udesh</option>
				</select>
			</p>
			<p><input type="submit" value="Select"></p>
		</form>
		
			<?php if(isset($friends)){ ?>
			
			<form id="batch_insert" action="" name="form_batch_insert" method="post">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

				<!-- Show Current Friends to Edit -->
				<?php if($friends){ ?>
					<h2>Edit Friends</h2>
					<table>
						<tr>
							<th>db id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Telephone</th>
							<th></th>
						</tr>
						<?php foreach($friends as $friend) { ?>
						<tr>
							<td>
								<input type="text" name="edit[<?php echo $friend->id;?>][name]" value="<?php echo $friend->id;?>" placeholder="Name" disabled />
							
								<input type="hidden" name="edit[<?php echo $friend->id;?>][id]" value="<?php echo $friend->id;?>" />
							</td>
							<td>
								<input type="text" name="edit[<?php echo $friend->id;?>][name]" value="<?php echo $friend->name;?>" placeholder="Name" />
							</td>
							<td>
								<input type="text" name="edit[<?php echo $friend->id;?>][email]" value="<?php echo $friend->email;?>" placeholder="Email" />
							</td>
							<td>
								<input type="text" name="edit[<?php echo $friend->id;?>][tele]" value="<?php echo $friend->telephone;?>" placeholder="Telephone" />
							</td>
							<td><?php echo anchor('samples/batch_insert/?action=del&fid='.$friend->id.'&user_id='.$user_id,'Remove');?></td>
						</tr>
						<?php } ?>
					</table>
					
					<p><input type="submit" value="Save"></p>
				<?php } ?>
				

				<!-- Add New Friends -->
				<h2>Add Friends</h2>
				
				<?php for($i=1;$i<3;$i++) { ?>
				<p><input type="text" name="new[<?php echo $i;?>][name]" value="" placeholder="Name" /></p>
				<p><input type="text" name="new[<?php echo $i;?>][email]" value="" placeholder="Email" /></p>
				<p><input type="text" name="new[<?php echo $i;?>][tele]" value="" placeholder="Telephone" /></p>
	<hr>
				<?php } ?>
				<!-- <p><input type="text" name="new[2][name]" value="" placeholder="Name" /></p>
				<p><input type="text" name="new[2][email]" value="" placeholder="Email" /></p>
				<p><input type="text" name="new[2][tele]" value="" placeholder="Telephone" /></p>
 -->
				<p><input type="submit" value="Save"></p>
			</form>

			<?php }else{ ?>
				<p>Please select a User.</p>
			<?php } ?>

			

			
</div>

</body>
</html>
