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
	max-height: 450px;
}

.image-details .details {
	float: left;
	padding: 5px 30px;
}

.image-details .details-text {
	font-size: 20px;
	padding: 5px 0;
}

.image-details #send-mail {
	text-align: center;
	font-size: 18px;
}

.image-details #mail-message {
	width: 100%;
	height: 110px;
}
</style>

<div class="content" style="margin-left: 25px;">

	<div class="image-details">
		<div class="image">
			<img
				src="<?php echo base_url('img') .'/uploads/'. $data['image']; ?>" />
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

			<div id="mail-text">
				<textarea id="mail-message"></textarea>
			</div>
			<div id="send-mail">
				<button id="mailButton">Send Email</button>
			</div>

			<script type="text/javascript">
			$('#mailButton').click( function() {
				console.log("sending emails..");
				var message = document.getElementById("mail-message").value;
				$.ajax ( {
					type:'post',
					cache: false,
					// use absolute url with a leading forward slash 
					// otherwise it's relative to the current folder
					url: "/eWeb/CI_LostFound/home/send_mail",  
					data: {
						from: "zpkx.wang@gmail.com", 
						to  : "wangnanbei@icloud.com",
						sbj : "Lost-Found",
						msg : escape(message)
					},
					success: function(data,status,jqXHR) {
						//alert(data);
					},
					error: function(jqXHR,status,errorThown) {
						alert(errorThown);
					},
					complete: function(jqXHR,status) { 
						alert(status);
					}
				});
			});
			</script>
		</div>
	</div>

</div>

<?php $this->load->view('template/v_admin_footer.php'); ?>