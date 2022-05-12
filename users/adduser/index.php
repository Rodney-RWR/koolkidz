
<?php
   $servername = "168.100.163.65:3306";
   $username = "u57_fcrHHilJt7";
   $password = "@FjbfqADTCk.Fkv5jT+Ro!61";
   $dbname = "s57_StaffWebsite";
     
   // connect the database with the server
   $conn = new mysqli($servername,$username,$password,$dbname);
     
    // if error occurs 
    if ($conn -> connect_errno)
    {
       echo "Failed to connect to MySQL: " . $conn -> connect_error;
       exit();
    }
  
    $sql = "CREATE TABLE stafflist (username varchar(100), role varchar(100);";
    $sql = "INSERT INTO vendors(username,role) VALUES('Asphy','Owner');";
    $result = ($conn->query($sql));
    //declare array to store the data of database
    $row = []; 
  
    if ($result->num_rows > 0) 
    {
        // fetch all data from db into array 
        $row = $result->fetch_all(MYSQLI_ASSOC);  
    }   
?>
