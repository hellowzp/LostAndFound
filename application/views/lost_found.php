<?php $this->load->view("template/v_admin_header.php"); ?>

<div class="content">
	<?php foreach ($data as $row) {
		$name = $row['name'];
		$description = $row['description'];
		$image = $row['email'];
	?>
		<div class="span4"></div>
	<?php } ?>
</div>

<?php $this->load->view("template/v_admin_footer.php"); ?>