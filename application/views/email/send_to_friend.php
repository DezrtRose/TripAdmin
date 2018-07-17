<body style="margin: 0; background: none repeat scroll 0% 0% rgb(222, 222, 222); padding: 10px; font-family: 'Open Sans', Helvetica, Arial, sans-serif; line-height: 2">
<div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); margin: 15px; padding: 15px;">
	<div style="padding: 15px 0;">
		<img src="<?php echo base_url('images/email-logo.png') ?>"/>
	</div>
	<p>
		<strong style="display: inline-block; width: 25%">Friend's name: </strong><?php echo ucwords(strtolower($sender_name)) ?><br/>
		<strong style="display: inline-block; width: 25%">Friend's email: </strong><?php echo $sender_email ?><br/>
		<strong style="display: inline-block; width: 25%">Trip link: </strong>
		<a href="<?php echo $trip_link ?>">
			<?php echo $trip_name ?>
		</a>
		<br/>
		<strong style="display: inline-block; width: 25%">Message:</strong><br/><?php echo $personal_msg ?><br/>
	</p>
</div>
</body>