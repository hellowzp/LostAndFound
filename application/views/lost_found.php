<?php $this->load->view("template/v_admin_header.php"); ?>

<style>
.galleryBox-wrapper {
	width: 80%;
	margin: 50px 10%;
}

.galleryBox {
	display: inline-block;
	width: 220px;
	height: 200px;
}

/* z-index only works for positioned elements: 
   relative or absolute etc, instead of static */
.galleryBox .thumbnail {
	width: 200px;
	height: 150px;
	position: relative;
}

.galleryBox .thumbnail:hover {
    border: 1px solid #FFF;
}

/*  http://host.sonspring.com/hoverbox
http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/
http://tympanus.net/codrops/2011/09/05/slicebox-3d-image-slider/
http://philipwalton.com/articles/what-no-one-told-you-about-z-index/
*/
.galleryBox img {
	-webkit-transform:scale(1.0); /*Webkit: Scale down image to 0.8x original size*/
	-moz-transform:scale(1.0); /*Mozilla scale version*/
	-o-transform:scale(1.0); /*Opera scale version*/
	-webkit-transition-duration: 0.5s; /*Webkit: Animation duration*/
	-moz-transition-duration: 0.5s; /*Mozilla duration version*/
	-o-transition-duration: 0.5s; /*Opera duration version*/
	opacity: 0.8; /*initial opacity of images*/
/*	margin: 0 10px 5px 0; margin between images*/
}

.galleryBox img:hover{
	-webkit-transform:scale(1.6); /*Webkit: Scale up image to 1.2x original size*/
	-moz-transform:scale(1.6); /*Mozilla scale version*/
	-o-transform:scale(1.6); /*Opera scale version*/
	box-shadow:0px 0px 30px gray; /*CSS3 shadow: 30px blurred shadow all around image*/
	-webkit-box-shadow:0px 0px 30px gray; /*Safari shadow version*/
	-moz-box-shadow:0px 0px 30px gray; /*Mozilla shadow version*/
	opacity: 1;
	z-index: 1;
}

.galleryBox .text {
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
		<div class="galleryBox-wrapper">
			<?php foreach ($data as $row) {
				$name = $row['name'];
				$description = $row['description'];
				$image = base_url('img/uploads') .'/' . $row['image'];
			?>
			<div class="galleryBox">
				<a target="_blank" href="<?php echo $image;?>">
					<img class="thumbnail" 
						 alt="<?php echo $name;?>" 
						 src="<?php echo $image;?>"
						 title="<?php echo $description;?>">
				</a>
				<p class="text"><?php echo $description;?></p>
			</div>
			<div class="galleryBox">
				<a target="_blank" href="<?php echo site_url('home/show_details') .'/'. $table .'/'. $row['image'];?>">
					<img class="thumbnail" 
						 alt="<?php echo $name;?>" 
						 src="<?php echo $image;?>"
						 title="<?php echo $description;?>">
				</a>		
				<p class="text"><?php echo $description;?></p>
			</div>
			<?php  } ?>	
		</div>
		
		<div class="gallery-nav"></div>
	<?php  } ?>
</div>


<?php $this->load->view("template/v_admin_footer.php"); ?>