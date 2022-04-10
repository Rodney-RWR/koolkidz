<br/>
<?<br/>
///////////////////////////////////////////////////////////////////////<br/>
// Change Htpasswd Script.<br/>
///////////////////////////////////////////////////////////////////////<br/>
// Quick script to change passwords for htpasswd files.<br/>
//<br/>
// Installation:<br/>
//   Simply copy this file into a directory that is web protected and<br/>
// update the script to point to the path of your actual htpasswd file.<br/>
// Also, insure that the webserver has read and write permissions.<br/>
//<br/>
// Author: David A. Horner (DAH) http://dave.thehorners.com<br/>
// License: Public Domain<br/>
///////////////////////////////////////////////////////////////////////<br/>
if(!include('File/Passwd/Authbasic.php')) {<br/>
   echo "Error, you must install some files into your pear configuration before continuing.<br>";<br/>
   echo "At the commandline (you might want to be root, or anyone with access to pear)<br>";<br/>
   echo "Run the following commands<br>";<br/>
   echo "pear install Auth<br>";<br/>
   echo "pear install File_Passwd<br>";<br/>
   exit();<br/>
}<br/>
<br/>
$HTPASSWD_PATH = "../htpasswd";<br/>
$REDIRECT_URL = "/";<br/>
$MIN_PASSLEN = 6;<br/>
$MAX_PASSLEN = -1;<br/>
<br/>
if(strlen($_SERVER["REMOTE_USER"])==0) {<br/>
   echo "Failed reading username from enviroment!<br>";<br/>
   echo "This program must be run from within a protected HTTP directory!";<br/>
   exit(0);<br/>
}<br/>
$user=$_SERVER["REMOTE_USER"];<br/>
$save_changes=false;<br/>
<br/>
echo "<html><head><title>Change Password Script</title></head><body>";<br/>
$passfile = new File_Passwd_Authbasic($HTPASSWD_PATH);<br/>
$ret = $passfile->load();<br/>
if(!PEAR::isError($ret)) {<br/>
<br/>
   echo "Hello $user, welcome to the password change script.<br>";<br/>
<br/>
   $verified=false;<br/>
   if(strlen($_REQUEST["currpass"])) {<br/>
      if($passfile->verifyPasswd($user,$_REQUEST["currpass"])) {<br/>
         $verified=true;<br/>
      } else {<br/>
         echo "Failed current password validation!<br>";<br/>
      }<br/>
   }<br/>
   $confirmed=false;<br/>
   if(strlen($_REQUEST["newpass"])) {<br/>
      if(strcmp($_REQUEST["newpass"],$_REQUEST["newpass2"])==0) {<br/>
         $confirmed=true;<br/>
      } else {<br/>
         echo "Failed new password and confirmed password don't match!";<br/>
      }<br/>
   } else if($verified) {<br/>
      echo "Failed you must supply a new password!";<br/>
   }<br/>
<br/>
   if($verified &amp;&amp; $confirmed) {<br/>
      $passfile->changePasswd($user, $_REQUEST["newpass"]);<br/>
      $save_changes=true;<br/>
   } else {<br/>
      echo "<table border=0>";<br/>
      echo "<tr><td colspan=2 bgcolor=cccccc>Change your password</td></tr>";<br/>
      echo "<form method=\"post\" action=\"$PHP_SELF\">";<br/>
      echo "<tr><td>Verify Current Password: </td>";<br/>
      echo "<td><input type=\"password\" name=\"currpass\"></td></tr>";<br/>
      echo "<tr><td>New Password: </td>";<br/>
      echo "<td><input type=\"password\" name=\"newpass\"></td></tr>";<br/>
      echo "<tr><td>New Password Again(to confirm): </td>";<br/>
      echo "<td><input type=\"password\" name=\"newpass2\"></td></tr>";<br/>
      echo "<tr><td colspan=2>";<br/>
      echo "<input type=\"submit\" name=\"submit\" value=\"Change Pass\">";<br/>
      echo "<input type=\"hidden\" name=\"redirect\" value=\"true\">";<br/>
      echo "</td></tr>";<br/>
      echo "</form>";<br/>
      echo "</table>";<br/>
   }<br/>
<br/>
/*<br/>
   if(strlen($_REQUEST["newuser"]) &amp;&amp;  $confirmed) {<br/>
      $newuser=$_REQUEST["newuser"];<br/>
      $newpass=$_REQUEST["newpass"];<br/>
      echo "Adding user $newuser with password $newpass...<br>";<br/>
      $ret=$passfile->addUser($newuser,$newpass);<br/>
      if(!PEAR::isError($ret)) {<br/>
         echo "Added user successfully!<br>";<br/>
         $save_changes=true;<br/>
      } else {<br/>
         echo "Failed to add user to password file!<br>";<br/>
         echo "(".$ret->getMessage().")<br>";<br/>
      }<br/>
   } else {<br/>
      echo "<table border=0>";<br/>
      echo "<tr><td colspan=2 bgcolor=cccccc>Add new user</td></tr>";<br/>
      echo "<form method=\"post\" action=\"$PHP_SELF\">";<br/>
      echo "<tr><td>New Username: </td>";<br/>
      echo "<td><input type=\"text\" name=\"newuser\"></td></tr>";<br/>
      echo "<tr><td>New Password: </td>";<br/>
      echo "<td><input type=\"password\" name=\"newpass\"></td></tr>";<br/>
      echo "<tr><td>New Password Again(to confirm): </td>";<br/>
      echo "<td><input type=\"password\" name=\"newpass2\"></td></tr>";<br/>
      echo "<tr><td colspan=2>";<br/>
      echo "<input type=\"submit\" name=\"submit\" value=\"Add User\">";<br/>
      echo "</td></tr>";<br/>
      echo "</form>";<br/>
      echo "</table>";<br/>
   }<br/>
*/<br/>
<br/>
   if($save_changes) {<br/>
      echo "Saving password file...<br>";<br/>
      $ret=$passfile->save();<br/>
      if(!PEAR::isError($ret)) {<br/>
         echo "Password file successfully updated!<br>";<br/>
         if(isset($_REQUEST["redirect"])) {<br/>
            echo "The browser will request your new username/password in 5 seconds....<br>";<br/>
            echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5; URL=$REDIRECT_URL\">";<br/>
         }<br/>
      } else {<br/>
         echo "Failed to write password file!<br>";<br/>
         echo "(".$ret->getMessage().")<br>";<br/>
      }<br/>
   }<br/>
<br/>
} else {<br/>
   echo "Failed to open password file!<br>";<br/>
   echo "(".$ret->getMessage().")<br>";<br/>
}<br/>
echo "</body></html>";<br/>
   //$users=$passfile->listUser();<br/>
   //print_r($users);<br/>
?><br/>
<br/>
