<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login</title>
   <link rel="stylesheet" href="<?php echo base_url('assets/css/w3.css') ?>">
</head>

<body>
   <div class="w3-content  w3-section ">
      <div class="w3-card-4">

         <form method="POST" action="/auth/loginCheck" class="w3-container w3-padding-large">
            <p class="w3-text-red">
               <?php
               $session = session();
               if ($session->getFlashdata('error')) {
                  echo $session->getFlashdata('error');
               }
               ?>
            </p>
            <p>
               <label>Username/Email</label>
               <input class="w3-input" type="text" name="email">
            </p>
            <p>
               <label>Password</label>
               <input class="w3-input" type="password" name="password">
            </p>
            <p>
               <input type="submit" class="w3-btn w3-ripple w3-indigo" value="Login">
            </p>
         </form>

      </div>
   </div>
</body>

</html>