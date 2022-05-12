
<?php
   $dbservername = "168.100.163.65:3306";
   $dbusername = "u57_fcrHHilJt7";
   $dbpassword = "@FjbfqADTCk.Fkv5jT+Ro!61";
   $dbname = "s57_StaffWebsite";
     
   // connect the database with the server
   $conn = new mysqli($dbservername,$dbusername,$dbpassword,$dbname);
     
    // if error occurs 
    if ($conn -> connect_errno)
    {
       echo "Failed to connect to MySQL: " . $conn -> connect_error;
       exit();
    }
  
    $sql = "select * from stafflist";
    $result = ($conn->query($sql));
    //declare array to store the data of database
    $row = []; 
  
    if ($result->num_rows > 0) 
    {
        // fetch all data from db into array 
        $row = $result->fetch_all(MYSQLI_ASSOC);  
    }   
?>
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
<tbody>
    <?php
     if(!empty($row))
     foreach($row as $rows)
     { 
   ?>
<tr>
<td><?php echo $rows['username']; ?></td>
<td><?php echo $rows['role']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php   
    mysqli_close($conn);
?>


<button onclick="window.location.href='/'" style="width:auto; text-align:center;">Home</button>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; text-align:center;">Account Details</button>
</body>
</html>
