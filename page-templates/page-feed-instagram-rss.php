<?php
/*
Template Name: Instagram RSS
*/
if (isset($_GET["username"])) {
	header('Content-Type: application/rss+xml; charset=ISO-8859-1');
	$feed = new DOMDocument();
	$feed->load('http://statigr.am/RSSFeed.php?username=' . $_GET["username"]);
?>

<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule">
	<channel>
		<title><?php echo $_GET["username"]; ?> Instagram Feed</title>
		<link>http://www.instagram.com/<?php echo $_GET["username"]; ?></link>
		<description>Instagram Feed for GNU @<?php echo $_GET["username"]; ?></description>

<?php
	$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');
	foreach($items as $item) {
		// get needed items
		$title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
		$image = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
		$link = $item->getElementsByTagName('link')->item(0)->firstChild->nodeValue;
		$pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
		// take apart description string and get image url
		$image = strstr($image, "img src='");
		$image = strstr($image, "'/></a>", true);
		$image = str_replace("img src='", "", $image);
		$image = str_replace("_7.jpg", "_6.jpg", $image);
?>

		<item>
	        <title><![CDATA[<?php echo $title; ?>]]></title>
	        <link><?php echo $link; ?></link>
	        <pubDate><?php echo $pubDate; ?></pubDate>
	        <media:content url="<?php echo $image; ?>" medium="image" type="image/jpg" width="306" height="306" />
	        <media:title><![CDATA[<?php echo $title; ?>]]></media:title>
	    </item>

<?php
	}
?>

	</channel>
</rss>

<?php
} else {
	header('Location: /');
}
?>