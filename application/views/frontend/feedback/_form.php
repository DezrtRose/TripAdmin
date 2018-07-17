<h4>Feedback Form</h4>
<div class="feedback-form">
    <?php flash() ?>
    <form action="" method="post">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="by" placeholder="Enter you name" class="form-control required">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter your email address" class="form-control required">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea rows="10" class="form-control required" name="desc" placeholder="Enter your message"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Driving Skills Rating</label>
                <div class="rate" id="skill"></div>
            </div>
            <div class="form-group">
                <label>Vehicle Condition Rating</label>
                <div class="rate" id="condition"></div>
            </div>
            <div class="form-group">
                <label>Cleanliness Rating</label>
                <div class="rate" id="clean"></div>
            </div>
            <div class="form-group">
                <label>Punctuality Rating</label>
                <div class="rate" id="punctual"></div>
            </div>
            <div style="display: inline-block">
                <!-- Add this line in your form -->
                <div class="QapTcha"></div>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
<script>
    $('.rate').raty({
        cancel: false,
        path: 'raty/images',
        hints: ['bad', 'poor', 'okay', 'good', 'awesome'],
        targetType: 'score',
        scoreName: function () {
            return $(this).attr('id');
        }
    });
    $(document).ready(function(){

        // More complex call
        $('.QapTcha').QapTcha({
            autoSubmit : false,
            autoRevert : true,
            PHPfile : 'qaptcha/php/Qaptcha.jquery.php'
        });
    });
</script>