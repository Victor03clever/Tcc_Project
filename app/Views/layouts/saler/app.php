<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- ================================================================= -->
  <?php
  $file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'saler' . DIRECTORY_SEPARATOR . str_replace('.php', '', $file) . '.php';
  require_once $file;

  ?>
  <!-- =============================================================== -->
</body>
</html>