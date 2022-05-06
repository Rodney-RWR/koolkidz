<!DOCTYPE html>
<html>
<head>
  <title> KoolKidz | Staff </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/index.css">
</head>
<body>

<?php
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

echo "<h1> Welcome "  . $username . "</h1>";
?>

<h2>Staff Member</h2>
<table>
<tr>
    <th>Username</th>
    <th>Role</th>
</tr>
<tr>
<tr><td>Asphy</td><td>Owner</td></tr>
</tr>
</table>


<button onclick="window.location.href='/'" style="width:auto; text-align:center;">Home</button>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; text-align:center;">Account Details</button>
</body>
</html>
