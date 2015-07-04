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

input[type="file"]#fileElem {
	/* Note: display:none on the input won't trigger the click event in WebKit.
       Setting visibility to hidden and width 0 works.*/
	visibility: hidden;
	width: 0;
	height: 0;
}

#fileSelect {
	/*
  color: #08233e;
  font-size: 18pt;
  padding: 12px;
  background: -webkit-gradient(linear, left top, left bottom,
      color-stop(0.5, rgba(255,255,255,0.3)), color-stop(0.5, #ffcc00), to(#ffcc00));
  background: -webkit-linear-gradient(top, rgba(255,255,255,0.3) 50%, #ffcc00 50%, #ffcc00);
  background: -moz-linear-gradient(top, rgba(255,255,255,0.3) 50%, #ffcc00 50%, #ffcc00);
  background: -ms-linear-gradient(top, rgba(255,255,255,0.3) 50%, #ffcc00 50%, #ffcc00);
  background: -o-linear-gradient(top, rgba(255,255,255,0.3) 50%, #ffcc00 50%, #ffcc00);
  background: linear-gradient(top, rgba(255,255,255,0.3) 50%, #ffcc00 50%, #ffcc00);
  background-color: #ffcc00;
  border: 1px solid #ffcc00;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  -o-border-radius: 10px;
  -ms-border-radius: 10px;
  border-radius: 10px;
  border-bottom: 1px solid #9f9f9f;
  -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
  -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
  -o-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
  -ms-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
  cursor: pointer;
  text-shadow: 0 1px #fff; */
}

#fileSelect:hover {
	/*
  background: -webkit-gradient(linear, left top, left bottom,
                               color-stop(0, #fff), color-stop(0.7, #ffcc00),
                               to(#ffcc00));
  background: -webkit-linear-gradient(top, #fff, #ffcc00 70%, #ffcc00);
  background: -moz-linear-gradient(top, #fff, #ffcc00 70%, #ffcc00);
  background: -o-linear-gradient(top, #fff, #ffcc00 70%, #ffcc00);
  background: -ms-linear-gradient(top, #fff, #ffcc00 70%, #ffcc00);
  background: linear-gradient(top, #fff, #ffcc00 70%, #ffcc00); */
}

#fileSelect:active {
	position: relative;
	top: 2px;
}
</style>

<div class="span12 well"
	style="margin-top: 50px; margin-left: 350px; padding: 2px 15px; width: 40%">

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
	
	<?php 
	$attr = array(
		'class' => "form",
//		'enctype' => "multipart/form-data", // used for post binary data such as a file
		'style' => "padding: 0;"
	);
	echo form_open( 'post_handler', $attr); 
	?>
	
		<fieldset>
		<legend style="margin-bottom: 15px;">New Post</legend>

		<div class="field">
			<label for="type">Category</label>
			<input type="radio" name="type" value="Lost" <?php echo $isChecked['lost']?>><span>Lost</span>
			<input type="radio" name="type" value="Found" <?php echo $isChecked['found']?>><span>Found</span>
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
			<input type="text" name="image" id="imageName"
				value="<?php echo $db['image']; ?>">
			<input type="file" accept="image/*"
				id="fileElem" multiple onchange="handleFiles(this.files)">
			<button id="fileSelect" type="button" 
				style="margin-bottom: 5px; margin-left: 5px;">Browse</button>
		</div>
		
		<script>
			var fileInput = document.querySelector('#fileElem');
			var fileButton = document.querySelector('#fileSelect');
			var fileText = document.querySelector('#imageName');
			
			function click(el) {
			    // Simulate click on the element.
			    var evt = document.createEvent('Event');
			    evt.initEvent('click', true, true);
			    el.dispatchEvent(evt);
			}
			
			fileButton.addEventListener('click', function(e) {
			    //click(fileInput); // Simulate the click with a custom event.
			    fileInput.click(); // Or, use the native click() of the file input.
			}, false);
			
			function handleFiles(files) {
			    fileText.value = files[0].name;
// 			    alert("ajax");
//			    console.log(files[0]);
			    
// 			    $.ajax({
// 	                url: "../post_handler/upload",
// 	                dataType: 'text',    // accept from server
// 	                enctype: 'multipart/form-data',
// 	                contentType: "false",  // don't set content type
// 	                processData: false,
// 	                data: files[0],                         
// 	                type: 'post',
// 	                success: function(data){
// 	                    alert(data); 
// 	                }
// 	     		});
			}
		</script>	

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

		<div class="field" style="padding-left: 200px;">
			<input type="submit" value="Submit" />
		</div>

	</fieldset>
	</form>
	
<?php } else {
	echo '<div class="success"><h3>'.$success.'</h3></div>';
} ?>
</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>