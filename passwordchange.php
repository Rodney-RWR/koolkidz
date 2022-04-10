<?php
/* --------------------------------------------------------------------
-- Configurable script to change users in htpasswd
-----------------------------------------------------------------------
-- This script will change users in an htpasswd file using
-- the PEAR Basic Authentication library. It imports header/footer files
-- if they are found so you can customize the look.
--
-- Installation:
--   Copy this file into a directory that is web protected and
-- update the script to point to the path of your actual htpasswd file.
-- You will need to make the htpasswd file is writable by the web server
-- user.
--
-- Author: Dan Afonso
-- Based on: David A. Horner (DAH) http://dave.thehorners.com
-- License: Public Domain
---------------------------------------------------------------------- */
// Edit the following to setup your script
$HTPASSWD_PATH = "/etc/svn/htpasswd";
$REDIRECT_URL = "/";
$MIN_PASSLEN = 6;
$MAX_PASSLEN = -1;
$HEADER_FILE = 'password_change_header.html';
$FOOTER_FILE = 'password_change_footer.html';
// Check for header template, and display it if it's there
if (is_readable($HEADER_FILE)){
  $fh = fopen($HEADER_FILE, 'r');
  fpassthru($fh);
  fclose($fh);
} else {
?>
<html><head><title>Change Password Script</title></head><body>
<style>
  .error_box {
    font-color: red;
    margin: 5px;
    border: thin solid red;
    background: goldenrod;
  }
</style>
<?php
}
if(!include('File/Passwd/Authbasic.php')) {
?>
<div class="error_box"><h1>Installation Error</h1>
Your PEAR configuration is missing some required modules. You can install these
by running:
<pre>
[machine ~]# <b>pear install Auth</b>
[machine ~]# <b>pear install File_Passwd</b>
</pre>
</div>
<?php
   exit();
}
if(strlen($_SERVER["REMOTE_USER"])==0) {
?>
<div class="error_box"><h1>Installation Error</h1>
This script must be run from a password protected directory on your web site.
Please visit <a href="http://wiki.apache.org/httpd/PasswordBasicAuth"> the
Apache Wiki</a> for more information
</div>
<?php
  exit(0);
}
/// Check if we can write to the htpasswd file
if (!is_writable($HTPASSWD_PATH)){
?>
<div class="error_box"><h1>Installation Error</h1>
Your htpasswd file is not writable. You can change this by either:
<pre>
[machine ~]> <b>chmod a+w <?php echo $HTPASSWD_PATH; ?></b>
</pre>
... or if you prefer more security, as root you can do:
<pre>
[machine ~]# <b>chown <?php
        $a = posix_getpwuid(posix_getuid());
        echo $a["name"] . ' ' . $HTPASSWD_PATH; ?></b>
</pre>
</div>
<?php
   exit();
}
// Start processing
$user=$_SERVER["REMOTE_USER"];
$save_changes=false;
$passfile = new File_Passwd_Authbasic($HTPASSWD_PATH);
$ret = $passfile->load();
if(!PEAR::isError($ret)) {
  echo "Hello $user, welcome to the password change script.<br>";
  $verified=false;
  if(isset($_REQUEST["currpass"]) && strlen($_REQUEST["currpass"])) {
    // The PEAR library does not handle the (defaut) crypt() password
    // hash. So we have to decode it manually. Luckally, all the SHA1
    // hashes start with {SHA1}, and '{' is not present in crypt()
    // hashes.
    $users = $passfile->listUser();
    $salt = substr($users[$_SERVER["REMOTE_USER"]], 0, 2);
    // Check SHA1 passwords
    if(isset($users[$_SERVER["REMOTE_USER"]]) &&
       $salt == '{S' &&
       $passfile->verifyPasswd($user,$_REQUEST["currpass"])
      ) {
      $verified=true;
      echo "Password validated via SHA1<br/>\n";
    }
    // Check crypt()
    elseif (isset($users[$_SERVER["REMOTE_USER"]]) &&
            (crypt($_REQUEST["currpass"], $salt) ==
             $users[$_SERVER["REMOTE_USER"]])) {
      $verified=true;
      echo "Password validated via crypt()<br/>\n";
    } else {
      echo '<div><b>Failed:</b> Your password did not match </div><br>';
    }
   }
   // Make sure the 2 passwords match
   $confirmed=false;
   if(isset($_REQUEST["newpass"]) && strlen($_REQUEST["newpass"]) > $MIN_PASSLEN) {
      if(strcmp($_REQUEST["newpass"],$_REQUEST["newpass2"]) == 0) {
         $confirmed=true;
      } else {
         echo '<div><b>Failed</b>: new password and confirmed password don\'t match.';
      }
   } else if($verified) {
      echo "<div class=\"error_box\"><b>Failed</b>: you must supply a new password
             and it must be at least $MIN_PASSLEN characters long.</div>";
   }
   if($verified && $confirmed) {
      $passfile->changePasswd($user, $_REQUEST["newpass"]);
      $save_changes=true;
   } else {
?>
<form method="post">
  <table border=0>
    <tr>
      <td colspan=2 bgcolor=cccccc>Change your password</td>
    </tr>
    <tr>
      <td>Verify Current Password: </td>
      <td><input type="password" name="currpass"></td>
    </tr>
    <tr>
      <td>New Password: </td>
      <td><input type="password" name="newpass"></td>
    </tr>
    <tr>
      <td>New Password Again(to confirm): </td>
      <td><input type="password" name="newpass2"></td>
    </tr>
    <tr>
      <td colspan=2><input type="submit" name="submit" value="Change Pass">
      <input type="hidden" name="redirect" value="true"></td>
    </tr>
  </table>
</form>
<?php
   }
   if($save_changes) {
      echo "Saving password file...<br/>";
      $ret=$passfile->save();
      if(!PEAR::isError($ret)) {
         echo "Password file successfully updated!<br/>";
         if(isset($_REQUEST["redirect"])) {
            echo "The browser will request your new username/password in
                  5 seconds....<br>";
            echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5; URL=$REDIRECT_URL\">";
         }
      } else {
         echo '<div><b>Failed</b>: Failed to write password file!<br>';
         echo "(".$ret->getMessage().")<br></div>";
      }
   }
} else {
   echo '<div><b>Failed</b>:Failed to open password file!<br>';
   echo "(".$ret->getMessage().")<br></div>";
}
// Display the footer
if (is_readable($FOOTER_FILE)){
  $fh = fopen($FOOTER_FILE, 'r');
  fpassthru($fh);
  fclose($fh);
} else {
  echo "</body></html>";
}
?>
