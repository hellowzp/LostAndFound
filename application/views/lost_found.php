<?php $this->load->view("template/v_admin_header.php"); ?>

<style>
.gallery-wrapper {
	width: 80%;
	margin: 50px 10%;
}

.gallery {
	display: inline-block;
	width: 220px;
	height: 200px;
}
.gallery .thumbnail {
	width: 200px;
	height: 150px;
}

.gallery img :hover {
    border: 1px solid #0000ff;
}

.gallery .text {
	text-align: center;
	font-size: 20px;
	padding-top: 5px;
	margin: 0;
	text-decoration: none;
}

</style>

<div class="content" style="margin-left: 40px;">
	
	<?php 
//	var_dump($data);
	if( !$data ){ 	// sizeof($data) == 0) {
		echo '<div style="margin: 100px 0; text-align: center;"><h1>There is no post yet! <a href="' 
			 . site_url("home/post") .'/' .$table. '">Click here to add new post</a>.</h1></div>';
	} else {		
	?>
		<div class="gallery-wrapper">
			<?php foreach ($data as $row) {
				$name = $row['name'];
				$description = $row['description'];
				$image = base_url('img/uploads') .'/' . $row['image'];
			?>
			<div class="gallery">
				<a target="_blank" href="<?php echo $image;?>">
					<img class="thumbnail" 
						 alt="<?php echo $name;?>" 
						 src="<?php echo $image;?>"
						 title="<?php echo $description;?>">
					<p class="text"><?php echo $description;?></p>
				</a>			
			</div>
			<div class="gallery">
				<a target="_blank" href="<?php echo $image;?>">
					<img class="thumbnail" 
						 alt="<?php echo $name;?>" 
						 src="<?php echo $image;?>"
						 title="<?php echo $description;?>">
					<p class="text"><?php echo $description;?></p>
				</a>			
			</div>
			<?php  } ?>	
		</div>
		
		<div class="gallery-nav"></div>
	<?php  } ?>
</div>


<?php $this->load->view("template/v_admin_footer.php"); ?>