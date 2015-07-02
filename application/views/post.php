<?php $this->load->view('template/v_admin_header.php'); 
$email_error = (trim ( form_error ( 'username' ) ) != '') ? ' error' : '';
?>

<div class="span12 well" style="margin-top: 30px; margin-left: 300px; width: 40%">

<?php echo validation_errors(); echo form_open('postHandler'); ?>

	<fieldset>
		<legend>New Post</legend>
		
		<label class="control-label" for="stuffName">Name</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="stuffName"
				name="stuffName" value="<?php echo set_value('stuffName'); ?>">
      	</div>
		
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="description"
				name="description" value="<?php echo set_value('description'); ?>">
      	</div>
		
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="description"
				name="description" value="<?php echo set_value('description'); ?>">
      	</div>
      	
      	<label class="control-label" for="image">Image</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="image"
				name="image" value="<?php echo set_value('image'); ?>">
			<button>Browse</button>
      	</div>
      	
      	<label class="control-label" for="description">Description</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="description"
				name="description" value="<?php echo set_value('description'); ?>">
      	</div>
		
		<h5>Email Address</h5>
		<input type="text" name="email" value="" size="50" />
		
		<div><input type="submit" value="Submit" /></div>
		
	</fieldset>
</form>
</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>