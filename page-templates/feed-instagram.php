<?php
/*
Template Name: Instagram JSON
*/

// REQUEST THE INSTAGRAM POSTS
$clientId = '4c33ba16771a4311948cfafffe58c345';
$clientSecret = 'e5af31a72a7d4bf19ecf42fe7bf07fd5';
// ACCESS TOKEN URL
// https://instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=token
// https://instagram.com/oauth/authorize/?client_id=4c33ba16771a4311948cfafffe58c345&redirect_uri=http://www.lib-tech.com&response_type=token
$accessToken = '18520998.4c33ba1.96c331f5f51c41159acb6544314d7640'; // libtechnologies user access token
$limit = 10; // set default limit
if (isset($_GET["limit"])) {
	$limit = $_GET["limit"]; // update limit if declared
}

if (isset($_GET["username"])) {
	header('Content-Type: application/json');
	$userInfo = file_get_contents('https://api.instagram.com/v1/users/search?q=' . $_GET["username"] . '&client_id=' . $clientId);
	$userInfo = json_decode($userInfo);
	$userId = $userInfo->data[0]->id; // grabs the user ID of the first returned username
	$userPhotos = file_get_contents('https://api.instagram.com/v1/users/' .  $userId . '/media/recent?access_token=' . $accessToken . '&count=' . $limit);
	echo $userPhotos;
} else if (isset($_GET["tag"])) {
	header('Content-Type: application/json');
	$clientId = '4c33ba16771a4311948cfafffe58c345'; // libtechnologies user access token
	$taggedPhotos = file_get_contents('https://api.instagram.com/v1/tags/' . $_GET["tag"] . '/media/recent?client_id=' . $clientId . '&count=' . $limit);
	echo $taggedPhotos;
} else {
	header('Location: /');
}
?>
