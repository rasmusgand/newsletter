<?php

include_once('functions.php');
if (count($argv) >= 2) {
	$files = array_reverse(aggregate_newsletters());
	$body = "";
	$count = count($files);

	foreach ($files as $file){
		$title = $file['title'];
		$link = NEWSLETTER_LINK.'entries.php#'.$count; //this should be dynamic
		$date = $file['date'];
		$content = $file['content'];
		$body .= 
			"<item>
				<title>$title</title>
				<link>$link</link>
				<pubDate>$date</pubDate>
				<content:encoded><![CDATA[$content]]></content:encoded>
			</item>";
		$count--;
	}

	$generatedContent = NEWSLETTER_HEADER.$body.NEWSLETTER_FOOTER;

	file_put_contents(NEWSLETTER_RSS_PATH,$generatedContent);
}
