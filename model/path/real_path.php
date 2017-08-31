<?php

$www_real_path = "/home/ludacmfrif/www";//On line path
if($_SERVER['HTTP_HOST'] == 'localhost'){
    $www_real_path = "C:\wamp64\www\ludacm\www"; //For WAMP
}
