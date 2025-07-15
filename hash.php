<?php
$pw = password_hash('password',PASSWORD_DEFAULT);
echo $pw."<br>";
var_dump(password_verify("password",$pw));

?>