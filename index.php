<?php

/** 2017/09/01 Version without if(server = wamp)
*   This code is now in a file in model directory.
*   Prettier an cleaner: better                 */

include_once("model/path/real_path.php");
include_once("model/security/htaccess_ok.php");
include_once('model/error/OvhErrorMessage.php');
include_once("model/config/config.php");

if (!isset($_GET['section']) OR $_GET['section'] == 'index'){
    include_once("controller/accueil/index.php");//include homepage controller
}

// Tools:
// var_dump();
// exit();
// include_once('model/show/SuperGlobal.php');
