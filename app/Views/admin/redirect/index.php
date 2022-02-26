<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <?php
   foreach ($css_files as $file) : ?>
      <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>
</head>

<body>
   <div>
      <a href="<?=base_url('logout')?>">LogOut</a>
   </div>
   <div style='height:20px;'></div>
   <div style="padding: 10px">
      <?php echo $output; ?>
   </div>
   <?php foreach ($js_files as $file) : ?>
      <script src="<?php echo $file; ?>"></script>
   <?php endforeach; ?>
</body>

</html>