
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?=asset(BOOTCSS)?>">
</head>
<body>


<main id="main" class="main">

<?php
$file = dirname(dirname(__DIR__)). DIRECTORY_SEPARATOR . 'admin'.DIRECTORY_SEPARATOR. str_replace('.php','',$file).'.php';
require_once $file;

?>


<script src="<?=asset(BOOTJS)?>"></script>
<script src="<?=asset(BOOTPOPPER)?>"></script>
</main>
</body>
</html>
  