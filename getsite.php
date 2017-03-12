<?php

require_once __DIR__.'/vendor/autoload.php';

use Goutte\Client;

function get_web_page($url)
{
	$client = new Client();
	$crawler = $client->request('GET', $url);

	var_dump($crawler);

        //echo "curl:url<pre>".$url."</pre><BR>";
    $options = array(
       // CURLOPT_RETURNTRANSFER => true,     // return web page
       // CURLOPT_HEADER         => false,    // don't return headers
       // CURLOPT_FOLLOWLOCATION => true,     // follow redirects
       // CURLOPT_ENCODING       => "",       // handle all encodings
       // CURLOPT_USERAGENT      => "spider", // who am i
       // CURLOPT_AUTOREFERER    => true,     // set referer on redirect
       // CURLOPT_CONNECTTIMEOUT => 15,      // timeout on connect
        //CURLOPT_TIMEOUT        => 15,      // timeout on response
       // CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects

    );

    $ch      = curl_init($url);
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    //$err     = curl_errno( $ch );
    //$errmsg  = curl_error( $ch );
    //$header  = curl_getinfo( $ch,CURLINFO_EFFECTIVE_URL );
    curl_close( $ch );

    //$header["errno"] = $err;
    //$header["errmsg"] = $errmsg;

    //change errmsg here to errno
    if ($errmsg)
    {
        echo "CURL:".$errmsg."<BR>";
    }
    return $content;
}


echo get_web_page('http://madingkampus.com');
