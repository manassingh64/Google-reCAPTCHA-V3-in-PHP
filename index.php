<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Google reCapctha Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>	
      <script async src="https://www.google.com/recaptcha/api.js?render=6Lehzd8ZAAAAAGk47ZpgDwqk2CyHjts1Rv_aWQlk"></script>
   <style>
   body{background-color:#f4f8fa;}
   </style>
   </head>

   <body>
      <div class="container col-sm-5" style="background-color:#ffffff; padding:25px; border: 1px solid #d9d8d8;">
         <h1 style="font-size: 21px; font-weight: bold;">Demo of Integrate Google reCAPTCHA V3 in PHP</h1>
        
         <form action="" method="post">

         <div id="alert_message"></div>


            <div class="form-group">
               <label for="pwd">Name:</label>
               <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="form-group">
               <label for="email">Comment:</label>
               <textarea name="comment" class="form-control" id="comment" placeholder="Enter your comment" required></textarea>
            </div>
            <input type="hidden" name="recaptcha_response" value="" id="recaptchaResponse">
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg" style="padding: 6px 46px; margin: 16px 0 0 0;">
            <div style="font-size: 12px; padding-top: 12px; color: #808080;">Note: This form is protected by Google reCAPTCHA.</div>
         </form>
      </div>

      <script>
        $('form').submit(function(event) {
            event.preventDefault(); //Prevent the default form submission
            grecaptcha.ready(function () {
                grecaptcha.execute('6Lehzd8ZAAAAAGk47ZpgDwqk2CyHjts1Rv_aWQlk', { action: 'submit' }).then(function (token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
            // Making the simple AJAX call to capture the data and submit     
            $.ajax({
                        url: 'submit_enquiry.php',
                        type: 'post',
                        data: $('form').serialize(),
                        dataType: 'json',
                        success: function(response){
                            var error = response.error;
                            var success = response.success;
                            if(error != "") {
                                $('#alert_message').html(error);
                            }
                            else {
                                $('#alert_message').html(success);
                            }
                        },
                        error: function(jqXhr, json, errorThrown){
                            var error = jqXhr.responseText;
                            $('#alert_message').html(error);
                        }
                    });

        });
      });
   });
    </script>

   </body>
</html>


