<?php
if (!defined('BASEPATH')) die('Access Denied!');

function error($code, $message)
{
    @header("HTTP/1.0 {$code} {$message}", true, $code);
    die($message);
}

function config($key, $value = null)
{
    static $_config = array();

    if ($key === 'source' && file_exists($value))
        $_config = parse_ini_file($value, true);
    elseif ($value == null)
        return (isset($_config[$key]) ? $_config[$key] : null);
    else
        $_config[$key] = $value;
}

function save_config($data = array(), $new = array())
{
    global $config_file;

    $string = file_get_contents($config_file) . "\n";

    foreach ($data as $word => $value) {
        $value = str_replace('"', '\"', $value);
        $string = preg_replace("/^" . $word . " = .+$/m", $word . ' = "' . $value . '"', $string);
    }
    $string = rtrim($string);
    foreach ($new as $word => $value) {
        $value = str_replace('"', '\"', $value);
        $string .= "\n" . $word . ' = "' . $value . '"' . "\n";
    }
    $string = rtrim($string);
    return file_put_contents($config_file, $string);
}

function rss_feed()
{
	$feed = new Feed();

	// Channel
    $channel = new Channel();
    $channel->title("Programming")
			->description("Programming with php")
			->url('http://bhaktaraz.com.np/?cat=2')
			->appendTo($feed);

	
	// RSS item
	$item = new Item();
	$item->title("CACHING DATA IN SYMFONY2")
		->description("It is not too easy to enhance the performance of your application. In Symfony2 you could get benefit from caching.")
		->url('http://bhaktaraz.com.np/?p=194')
		->enclosure('http://bhaktaraz.com.np/wp-content/uploads/2014/08/bhakta-672x372.jpg', 4889, 'audio/mpeg')
		->appendTo($channel);

	echo $feed;
}

?>