<body style="margin: 0; background: none repeat scroll 0% 0% rgb(222, 222, 222); padding: 10px; font-family: 'Open Sans', Helvetica, Arial, sans-serif; line-height: 2">
    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); margin: 15px; padding: 15px;">
        <div style="padding: 15px 0;">
            <img src="<?php echo base_url('images/email-logo.png') ?>"/>
        </div>
        <p style="margin: 0;">Dear <?php echo ucwords(strtolower($first_name)) ?>,</p>
        <p>
            Thank you for contacting us. We will get back to you as soon as possible.
        </p>
        <p>
            <h3 style="margin-bottom: 0; color: rgb(74, 150, 219); text-transform: uppercase;">With Regards</h3>
            <?php echo $this->site_data->title ?><br/>
            Address: <?php echo $this->site_data->address1 ?><br/>
            Phone: <?php echo $this->site_data->phone1 ?><br/>
            Website: <?php echo SITE ?>
        </p>
    </div>
</body>