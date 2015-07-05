<?php $this->load->view('template/v_admin_header.php'); ?>

<style>
.form {
	padding: 20px;
}

.form .field {
	margin: 1px;
	background: #eee;
}

.form .field label {
	display: inline-block;
	width: 80px;
	margin-left: 5px;
}

.form .field input {
	display: inline-block;
	margin-top: 5px;
}

.form .field span {
	display: inline-block;
	margin-top: 15px;
	margin-left: 4px;
	margin-right: 30px
}

.error {
	color: red;
}

/* http://codepen.io/escapist/pen/enkDl */
input[type="file"] #fileElem {
	/* Note: display:none on the input won't trigger the click event in WebKit.
       Setting visibility to hidden and width 0 works. */
	visibility: hidden;
	width: 0;
	height: 0; 
}

.input-panel {
	float: left;
	width: 40%;
}

.image-panel {
	float: right;
	width: 60%;
}

.image-panel .uploader
{
	border: 2px dotted #A5A5C7;
	width: 100%;
	height: 290px;
	color: #92AAB0;
	text-align: center;
	vertical-align: middle;
	padding: 0;
	margin-bottom: 5px;
	margin-right: 3px;
	font-size: 200%;

	cursor: default;

	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;	
}

/* align button text
input[type="file"] {
	line-height: 10px;
} */
</style>

<div class="well" style="margin-top: 50px; margin-left: 150px; padding: 2px 15px; width: 70%">

<?php  $isChecked = array();
	if( $table == 'found') {
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
	
	<?php 
	$attr = array(
		'class' => "form",
		'enctype' => "multipart/form-data", // used for post binary data such as a file
		'style' => "padding: 0;"
	);
	echo form_open( 'post_handler', $attr); 
	?>
	
		<fieldset>
		<legend style="margin-bottom: 15px;">New Post</legend>

		<div class="input-panel">
			<div class="field">
				<label for="type">Category</label>
				<input type="radio" name="type" value="lost" 
					<?php echo $isChecked['lost']?>><span>Lost</span>
				<input type="radio" name="type" value="found"
					<?php echo $isChecked['found']?>><span>Found</span>
			</div>

			<div class="field">
				<label for="name">Name</label> <input name="name" type="text"
					size="50" autofocus value="<?php echo $db['name']; ?>">
			</div>

			<div class="field">
				<label for="location">Description</label> <input type="text"
					name="description" value="<?php echo $db['description']; ?>">
			</div>

			<div class="field">
				<label for="image">Image</label>
				<input type="text" name="image" title="clock the Browse button to upload a image"
					id="imageText" readOnly value="<?php echo $db['image']; ?>">
			</div>

			<div class="field">
				<label>Date</label> <input type="date" name="date"
					value="<?php echo $db['date']; ?>">
			</div>

			<div class="field">
				<label>Location</label> <input type="text" name="location"
					value="<?php echo $db['location']; ?>">
			</div>

			<div class="field">
				<label>Email</label> <input type="text" name="email"
					value="<?php echo $db['email']; ?>">
			</div>
			
			<div class="field" style="padding-left: 45%;">
				<input type="submit" value="Submit" />
			</div>
			
		</div>

		<div class="image-panel">
			<div class="uploader">
				<div style="margin-top: 30%">Image Preview</div>
			</div>
			
			<div class="browser">
				<input type="file" id="fileElem" accept="image/*" name="imgFile"
					style="visibility: hidden; width: 0; height: 0;" onchange="handleFiles(this.files)">
	  			<button type="button" id="fileSelect" style="margin:1px 0 0 45%;">Browse</button>
			</div>
			
			<script type="text/javascript">			
				var fileInput = document.querySelector('#fileElem');
				var fileButton = document.querySelector('#fileSelect');
				var fileText = document.querySelector('#imageText');

				var imageContainer = $('.uploader');

				function click(el) {
				    // Simulate click on the element.
				    var evt = document.createEvent('Event');
				    evt.initEvent('click', true, true);
				    el.dispatchEvent(evt);
				}

				fileButton.addEventListener('click', function(e) {
				    //click(fileInput); // Simulate the click with a custom event.
				    fileInput.click();  // Or, use the native click() of the file input.
				}, false);

				function handleFiles(files) {
				    fileText.value = files[0].name;

				    var reader = new FileReader();
				    reader.onload = function(e) {
				    	imageContainer.html('<img src="' + e.target.result + '" width=100% height=100%/>');
				    };
				    reader.readAsDataURL(files[0]);
				}
	    	</script>
    	
		</div>		

	</fieldset>
	</form>
	
<?php } else {
	echo '<div class="success"><h3>'.$success.'</h3></div>';
} ?>
</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>