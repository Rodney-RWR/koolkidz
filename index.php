<!DOCTYPE html>
<html>
<head>
  <title> KoolKidz | Staff </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

echo "<h1> Welcome "  . $username . "</h1>";
?>

<button onclick="window.location.href='/punishments'" style="width:auto;">View Punishments</button>
<button onclick="window.location.href='/users/<?= $username ?>'" style="width:auto;">User Page</button>

</body>
</html>
