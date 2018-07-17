<body style="margin: 0; background: none repeat scroll 0% 0% rgb(222, 222, 222); padding: 10px; font-family: 'Open Sans', Helvetica, Arial, sans-serif; line-height: 2">
<div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); margin: 15px; padding: 15px;">
    <div style="padding: 15px 0;">
        <img src="<?php echo base_url('images/email-logo.png') ?>"/>
    </div>
    <p>
        <strong style="display: inline-block; width: 25%">IP Address: </strong><a href="https://tools.keycdn.com/geo?host=<?php echo $_SERVER['REMOTE_ADDR'] ?>" target="_blank"><?php echo $_SERVER['REMOTE_ADDR'] ?></a><br/>
        <strong style="display: inline-block; width: 25%">Name: </strong><?php echo ucwords(strtolower($first_name)) ?><br/>
        <strong style="display: inline-block; width: 25%">Email: </strong><?php echo $email ?><br/>
        <strong style="display: inline-block; width: 25%">Phone: </strong><?php echo $phone ?><br/>
        <strong style="display: inline-block; width: 25%">Message</strong><br/><?php echo $message ?><br/>
    </p>
</div>
</body>