<!DOCTYPE html>
<html>
<head>
  <title> KoolKidz | Console </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

echo "<h1> Welcome "  . $username . "</h1>";
?>
  
<embed type="text/html" src="https://panel.myth.host/" width="700" height="400">
</body>
</html>
