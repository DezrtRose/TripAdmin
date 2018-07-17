<body style="margin: 0; background: none repeat scroll 0% 0% rgb(222, 222, 222); padding: 10px; font-family: 'Open Sans', Helvetica, Arial, sans-serif; line-height: 2">
<div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); margin: 15px; padding: 15px;">
    <div style="padding: 15px 0;">
        <img src="<?php echo base_url('images/email-logo.png') ?>"/>
    </div>
    <div>
        <p>
        <h3 style="margin-bottom: 0; color: rgb(74, 150, 219); text-transform: uppercase;">
            <u>Trip Details</u>
        </h3>
        <strong>Trip Name: </strong><?php echo $trip ?><br/>
        <strong>Nationality: </strong><?php echo $country ?><br/>
        <strong>Start Date: </strong><?php echo $date ?><br/>
        <strong>Number of Travellers: </strong><?php echo $pax ?><br/>
        </p>
    </div>
    <div>
        <p>
        <h3 style="margin-bottom: 0; color: rgb(74, 150, 219); text-transform: uppercase;">
            <u>Traveller Information</u>
        </h3>
        <strong>IP Address: </strong><a href="https://tools.keycdn.com/geo?host=<?php echo $_SERVER['REMOTE_ADDR'] ?>" target="_blank"><?php echo $_SERVER['REMOTE_ADDR'] ?></a><br/>
        <strong>Name: </strong><?php echo $first_name.' '.$last_name ?><br/>
        <strong>Country: </strong><?php echo $country ?><br/>
        <strong>Email: </strong><?php echo $email ?><br/>
        <strong>Phone Number: </strong><?php echo $phone ?><br/>
        <strong>Age: </strong><?php echo $age ?><br/>
        <strong>Gender: </strong><?php echo $gender ?><br/>
        <strong>Mailing Address: </strong><?php echo $mailing_address ?><br/>
        <strong>Passport Number: </strong><?php echo $passport ?><br/>
        <strong>Place of Issue: </strong><?php echo $issue ?><br/>
        <strong>Issue Date: </strong><?php echo $issue_date ?><br/>
        <strong>Expiration Date: </strong><?php echo $exp_date ?><br/>
        <strong>Emergency Contact: </strong><?php echo $emergency ?><br/>
        <strong>Insurance: </strong><?php echo $insurance == 'yes' ? 'Full Insurance' : 'Will provide later' ?>
        <strong>Special Request: </strong><?php echo $special_request ?>
        </p>
    </div>
</div>
</body>