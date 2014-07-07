<?php 
/*
Template Name: Facebook Feed Template
*/

$clientId = '352899581451617';
$clientSecret = 'dc364b5bd9ffd2c6b3c259b951bcacaf';
$limit = 10; // set default limit
if (isset($_GET["limit"])) {
	$limit = $_GET["limit"]; // update limit if declared
}

if (isset($_GET["username"])) {
	header('Content-Type: application/json');
	// get the access token for the app
	$fbAccessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id=' . $clientId . '&client_secret=' . $clientSecret);
	// get the facebook posts
	$fbPosts = file_get_contents('https://graph.facebook.com/' . $_GET["username"] . '/posts?fields=type,from,link,created_time,picture,likes,message&limit=' . $limit . '&' . $fbAccessToken);
	echo $fbPosts;
} else {
	header('Location: /');
}
?>