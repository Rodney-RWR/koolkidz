<!DOCTYPE html>
<html>
<head>
  <title> KoolKidz | Console </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/index.css">
</head>
<body>

<?php
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

echo "<h1> Welcome "  . $username . "</h1>";
?>
  
  
<iframe src="https://panel.myth.host/" width="100%" height="300">
  <p>Your browser does not support console.</p>
</iframe>
</body>
</html>
