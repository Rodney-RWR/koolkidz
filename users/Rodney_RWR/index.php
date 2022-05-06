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

<button onclick="window.location.href='/'" style="width:auto; text-align:center;">Home</button>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; text-align:center;">Account Details</button>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
        <?= $username;?>

      <label for="psw"><b>Password</b></label>
        <?= $password;?>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Close</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
