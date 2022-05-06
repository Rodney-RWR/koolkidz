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

<h2>Staff Members</h2>
<table>
<tr>
    <th>Username</th>
    <th>Role</th>
</tr>
<tr>
<tr><td>
    Asphy
</td><td>
    Owner
</td></tr>
<tr><td>
    King_Eloy
</td><td>
    Owner
</td></tr>
<tr><td>
    Thunder
</td><td>
    Manager
</td></tr>
<tr><td>
    LargeDragon
</td><td>
    Admin
</td></tr>
<tr><td>
    Qwazimoto
</td><td>
    Admin
</td></tr>
<tr><td>
    Rodney_RWR
</td><td>
    Head Developer
</td></tr>
<tr><td>
    Ben
</td><td>
    Developer
</td></tr>
<tr><td>
    Plazma
</td><td>
    Moderator
</td></tr>
<tr><td>
    Randy
</td><td>
    Moderator
</td></tr>
<tr><td>
    Turtle
</td><td>
    Moderator
</td></tr>
<tr><td>
    Vicmur
</td><td>
    Moderator
</td></tr>
<tr><td>
    PopApplenik
</td><td>
    Trainee
</td></tr>
<tr><td>
    Crugs
</td><td>
    Trainee
</td></tr>
<tr><td>
    Wolfie
</td><td>
    Trainee
</td></tr>
<tr><td>
    Crown of England
</td><td>
    Builder
</td></tr>
<tr><td>
    Amelia
</td><td>
    Builder
</td></tr>
<tr><td>
    Hitman
</td><td>
    Designer
</td></tr>
<tr><td>
    Wessel
</td><td>
    Helper
</td></tr>
<tr><td>
    Volut
</td><td>
    Helper
</td></tr>
<tr><td>
    Reon
</td><td>
    Helper
</td></tr>
<tr><td>
    Commander
</td><td>
    Helper
</td></tr>
</tr>
</table>


<button onclick="window.location.href='/'" style="width:auto; text-align:center;">Home</button>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; text-align:center;">Account Details</button>
</body>
</html>
