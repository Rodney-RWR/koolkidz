<?php class htpasswd {
    var $fp;
    var $filename;
 
    function htpasswd($filename) {
        @$this->fp = fopen($filename,'r+') or die('Invalid file name');
        $this->filename = $filename;
    }
 
    function user_exists($username) {
        rewind($this->fp);
            while(!feof($this->fp)) {
                $line = rtrim(fgets($this->fp));
                if(!$line)
                    continue;
                $lusername = explode(":",$line)[0];
                if($lusername == $username)
                    return 1;
            }
        return 0;
    }
 
    function user_add($username,$password) {
        if($this->user_exists($username))
            return false;
        fseek($this->fp,0,SEEK_END);
        fwrite($this->fp,$username.':'.crypt($password,substr(str_replace('+','.',base64_encode(pack('N4', mt_rand(),mt_rand(),mt_rand(),mt_rand()))),0,22))."\n");
        return true;
    }
 
    function user_delete($username) {
        $data = '';
        rewind($this->fp);
        while(!feof($this->fp)) {
            $line = rtrim(fgets($this->fp));
            if(!$line)
                continue;
            $lusername = explode(":",$line)[0];
            if($lusername != $username)
                $data .= $line."\n";
        }
        $this->fp = fopen($this->filename,'w');
        fwrite($this->fp,rtrim($data).(trim($data) ? "\n" : ''));
        fclose($this->fp);
        $this->fp = fopen($this->filename,'r+');
        return true;
    }
 
    function user_update($username,$password) {
        rewind($this->fp);
            while(!feof($this->fp)) {
                $line = rtrim(fgets($this->fp));
                if(!$line)
                    continue;
                $lusername = explode(":",$line)[0];
                if($lusername == $username) {
                    fseek($this->fp,(-15 - strlen($username)),SEEK_CUR);
                    fwrite($this->fp,$username.':'.crypt($password,substr(str_replace('+','.',base64_encode(pack('N4', mt_rand(),mt_rand(),mt_rand(),mt_rand()))),0,22))."\n");
                    return true;
                }
            }
        return false;
    }
}
?/>
