<?php
$options = array('cost' => 11);
echo password_hash("admin", PASSWORD_BCRYPT, $options)."\n";
?>