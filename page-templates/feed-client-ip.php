<?php
/*
Template Name: Client IP Address
*/

header('content-type: application/json; charset=utf-8');
echo '{ "ip": "' . $_SERVER['REMOTE_ADDR'] . '" }';
?>