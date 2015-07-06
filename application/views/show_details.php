<?php $this->load->view('template/v_admin_header.php'); ?>

<style>
.image-details {
	display: inline-block;
	width: 90%;
	margin: 50px 5% 0;
}

.image-details .image {
	float: left;
    padding: 5px;
    line-height: 1;
    border: 2px solid #ddd;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
    max-width: 600px;
    max-height: 450px
}

.image-details .details {
	float: left;
	padding: 5px 30px;
}

.image-details .details-text {
	font-size: 20px;
	padding: 5px 0;
}
</style>


<div class="content" style="margin-left: 25px;">

	<div class="image-details">
		<div class="image">
			<img src="<?php echo base_url('img') .'/uploads/'. $data['image']; ?>" />
		</div>
		<div class="details">
			<fieldset>
				<legend style="font-size: 22px;">Image details</legend>
				<p class="details-text">Name: <?php echo $data['name']?></p>
				<p class="details-text">Description: <?php echo $data['description']?></p>
				<p class="details-text">Date: <?php echo $data['date']?></p>
				<p class="details-text">Location: <?php echo $data['location']?></p>
				<p class="details-text">Contact: <?php echo $data['email']?></p>
			</fieldset>
		</div>
	</div>

</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>