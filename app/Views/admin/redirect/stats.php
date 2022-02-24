<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login</title>
   <link rel="stylesheet" href="<?php echo base_url('public/assets/css/w3.css') ?>">
</head>

<body>
   <div class="w3-container">
      <div class="w3-section">
         <b>
            <a href="/admin/redirect">
               Back to list
            </a>
         </b>
      </div>
      <div class="w3-section">
         <a target="_blank" href="<?= $redirect['to'] ?>"> <?= MAIN_URL ?>/<?= $redirect['from']  ?></a>
      </div>
      <div class="w3-section">
         <form action="">
            From
            <input value="<?= (isset($_GET['from']) ? $_GET['from'] : '') ?>" name="from" id="from" type="date">
            To
            <input value="<?= (isset($_GET['to']) ? $_GET['to'] : '') ?>" name="to" id="to" type="date">

            <button type="submit">Filter</button>
         </form>
      </div>
      <div class="w3-row">
         <div class="w3-half">
            <h4>
               By Hits
            </h4>
            <div class="w3-margin">
               <div class="w3-section w3-border w3-padding">
                  <span class="stats-title">Total visitors:</span>
                  <span class="stats-title"><?= count($uVisits) ?></span>
               </div>
               <div class="w3-section w3-border w3-padding">
                  <span class="stats-title">Total visits:</span>
                  <span class="stats-title"><?= count($totalVisits) ?></span>
               </div>
               <div class="w3-section w3-border w3-padding">
                  <span class="stats-title">Total Bot visits:</span>
                  <span class="stats-title"><?= isset($device['bot']) ? count($device['bot']) : 0 ?></span>
               </div>
            </div>
         </div>
         <div class="w3-half">
            <div class="w3-margin">
               <h4>
                  By Browsers
               </h4>
               <?php
               foreach ($browsers as $key => $val) {
               ?>
                  <div class="w3-section w3-border w3-padding">
                     <span class="stats-title"><?= $key ?>:</span>
                     <span class="stats-title"><?= count($val) ?></span>
                  </div>
               <?php
               }
               ?>
            </div>
         </div>
         <div class="w3-half">
            <div class="w3-margin">
               <h4>
                  By Device
               </h4>
               <?php
               foreach ($device as $key => $val) {
               ?>
                  <div class="w3-section w3-border w3-padding">
                     <span class="stats-title"><?= $key ?>:</span>
                     <span class="stats-title"><?= count($val) ?></span>
                  </div>
               <?php
               }
               ?>
            </div>
         </div>
         <div class="w3-half">
            <div class="w3-margin">
               <h4>
                  By OS
               </h4>
               <?php
               foreach ($os as $key => $val) {
               ?>
                  <div class="w3-section w3-border w3-padding">
                     <span class="stats-title"><?= $key ?>:</span>
                     <span class="stats-title"><?= count($val) ?></span>
                  </div>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
</body>

</html>