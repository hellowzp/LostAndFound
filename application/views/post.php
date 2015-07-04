<?php $this->load->view('template/v_admin_header.php'); ?>

<style>
	.form { padding:20px; }
	
	.form .field { margin:1px; background: #eee; }
	
	.form .field label { display:inline-block; width:80px; margin-left:5px; }
	
	.form .field input { display:inline-block; margin-top: 5px; }
	
	.form .field span { display:inline-block; margin-top: 15px; margin-left: 4px; margin-right: 30px}
	
	.error { color: red; }
</style>

<div class="span12 well" style="margin-top: 50px; margin-left: 300px; padding: 2px 15px; width: 40%">

<?php  $isChecked = array();
	if ( isset($table) && $table == 'Found') {
		 $isChecked['lost'] = '';
		 $isChecked['found'] = 'checked';
	} else {
		$isChecked['lost'] = 'checked';
		$isChecked['found'] = '';
	}
    if (!isset($db['name'])) $db['name'] = '';
    if (!isset($db['description'])) $db['description'] = '';
    if (!isset($db['image'])) $db['image'] = '';
    if (!isset($db['date'])) $db['date'] = date('Y-m-d');
    if (!isset($db['location'])) $db['location'] = '';
    if (!isset($db['email'])) $db['email'] = '';
  
    if (!isset($success)) {	  	 
?>

	<div class="error"><?php echo validation_errors(); ?> </div>
	<?php echo form_open('postHandler', 
					array('class' => "form", 'style' => "padding: 0;") 
	); ?>
	
		<fieldset>
			<legend style="margin-bottom: 15px;">New Post</legend>
			
			<div class="field">
				<label for="type">Type</label>
	      		<input type="radio" name="type" value="Lost" <?php echo $isChecked['lost']?>><span>Lost</span>
	      		<input type="radio" name="type" value="Found" <?php echo $isChecked['found']?>><span>Found</span>
			</div>
			
			<div class="field">
		        <label for="name">Name</label>
		        <input name="name" type="text" size="50" autofocus value="<?php echo $db['name']; ?>">
	    	</div>
	
			<div class="field">
				<label for="location">Description</label>
				<input type="text" name="description" value="<?php echo $db['description']; ?>">
	      	</div>
	      	
			<div class="field"><label for="image">Image</label>
				<input type="text" name="image" value="<?php echo $db['image']; ?>">
				<button type="button" style="margin-bottom: 6px; margin-left: 15px;">Browse</button>
	      	</div>
	      	
			<div class="field"><label>Date</label>
				<input type="date" name="date" value="<?php echo $db['date']; ?>">
	      	</div>
	      	
			<div class="field"><label>Location</label>
				<input type="text" name="location" value="<?php echo $db['location']; ?>">
	      	</div>
			
			<div class="field"><label>Email</label>
				<input type="text" name="email" value="<?php echo $db['email']; ?>">
	      	</div>
	      	
			<div class="field" style="padding-left: 200px;"><input type="submit" value="Submit" /></div>
			
		</fieldset>
	</form>
	
<?php } else {
	echo '<div class="success"><h3>'.$success.'</h3></div>';
} ?>
</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>