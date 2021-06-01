<?php

function rss_feed()
{
	$feed = new Feed();

    $channel = new Channel();
    $channel
	->title("Programming")
	->description("Programming with php")
	->url('http://bhaktaraz.com.np/?cat=2')
	->appendTo($feed);

// RSS item
$item = new Item();
$item
	->title("CACHING DATA IN SYMFONY2")
	->description("It is not too easy to enhance the performance of your application. In Symfony2 you could get benefit from caching.")
	->url('http://bhaktaraz.com.np/?p=194')
	->enclosure('http://bhaktaraz.com.np/wp-content/uploads/2014/08/bhakta-672x372.jpg', 4889, 'audio/mpeg')
	->appendTo($channel);

echo $feed;
}

?>