<?php
//require 'core.php';
ob_start();
session_start();
session_destroy();
//header('Location: '.$http_referer);
//header('Location: '.$current_file);
include "index.php";
?>