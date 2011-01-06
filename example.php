<?php

ini_set('display_errors',true);
header('Content-type: text/html; charset=UTF-8');

require_once 'src/phpSpotify/Spotify.php';

$apiversion=1;
$spotifyurl='http://ws.spotify.com/';
$artist='winnerbäck';
$albumuri='spotify:album:6G9fHYDCoyEErUkHrFYfs4';

$spotify = new phpSpotify\Spotify();
$spotify2 = new phpSpotify\Spotify($spotifyurl,$apiversion);

echo '<pre>';
$results=$spotify->lookup($albumuri);
var_dump($results->info);

$results2=$spotify->searchArtist($artist);
var_dump($results2->info);

$results3=$spotify->foo($artist);
var_dump($results3->info);
echo '</pre>';